<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Compras\articulo_comprado;
use App\Models\Compras\Producto;
use App\Models\Programacion\Deporte;
use App\Models\Ventas\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ListadoVenta = Venta::all();
        return view('Ventas.ventas')->with('listado', $ListadoVenta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $Productos = Producto::select(['ProductoId', 'NombreProducto', 'TipoProducto', 'Talla', 'PrecioVenta', 'Cantidad', 'proveedores.NombreEmpresa'])
            ->join('proveedores', 'proveedores.Nit', '=', 'productos.Nit')
            ->get();
        // ->where('productos.Estado','=',1)

        return view('Ventas.crearventa')->with('productos', $Productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos = $request->productos;
        $articulosComprados = [];

        if ($productos == null) {
            return 'Evite enviar productos vacío';
        }

        foreach ($productos as $item) {
            // Crea las rutas para rescatar datos del request
            $rutaCantidad = strval($item . '_cantidad');
            $rutaValorUnitario = strval($item . '_unitValue');

            // Llena el objeto con los datos de un producto adicionado
            $articulos = new articulo_comprado();
            $articulos->ProductoId = $item;
            $articulos->Cantidad = $request->$rutaCantidad;
            $articulos->PrecioCompra = $request->$rutaValorUnitario;

            // Llena el array de validable con los datos del objeto
            $validable = ['ProductoId' => $item, 'Cantidad' => $request->$rutaCantidad, 'PrecioCompra' => $request->$rutaValorUnitario];

            // Valida que el objeto no tenga campos vacíos
            $validator = Validator::make(
                $validable,
                ['Cantidad' => 'required|min:1', 'PrecioCompra' => 'required|min:0']
            );
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Guarda Objeto en array si este pasa la validación
            array_push($articulosComprados, $articulos);
        }



        foreach ($articulosComprados as $item) {
            // Crea registros en la tabla de artículos comprados
            $articulo = new articulo_comprado();
            $articulo->ArticulosCompradosId = articulo_comprado::creadorPK($articulo, 1000);
            $articulo->ProductoId = $item->ProductoId;
            $articulo->NumeroFactura = $request->NumeroFactura;
            $articulo->Cantidad = $item->Cantidad;
            $articulo->PrecioCompra = $item->PrecioCompra;
            $articulo->save();

            // Modifica la cantidad en los registros de los productos
            $deporte = Producto::find($item->ProductoId);
            $Cantidad = $deporte->Cantidad + $item->Cantidad;
            $deporte->Cantidad = $Cantidad;
            $deporte->save();
        }

        return redirect('dashboard/panel');
    }


    public function listselected(Request $request)
    {
        $ProductModel = new Producto();
        $Selecteds = json_decode($request->seleccionados);
        $checkeds = $ProductModel->whereIn('ProductoId', $Selecteds)->select('NombreProducto')->get();
        return json_encode($checkeds);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Selected =  Venta::all()->where('VentaId', '=', $id);
        return view('Ventas.editarventas')->with('ventadata', $Selected);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            ['Documento' => 'min:1|unique:ventas,Documento|max:11', 'FechaVenta' => 'min:1|max:20', 'ValorVenta' => 'min:1|max:20', 'SubTotal' => 'min:1|unique:ventas,SubTotal|max:20', 'IVA' => 'min:1|max:20', 'Descuento' => 'min:1|max:20'],
            ['unique' => 'Este campo no acepta información que ya se ha registrado', 'min' => 'No puedes enviar este campo vacío', 'max' => 'Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $venta = Venta::find($id);
        $Campos = ['Documento', 'FechaVenta', 'ValorVenta', 'SubTotal', 'IVA', 'Descuento'];
        foreach ($Campos as $item) {
            $venta->$item = $request->$item;
        }
        $venta->save();
        return redirect('venta/listar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Área de adición de producto

    /**
     * @var ProductoId
     * @var Cantidad
     * 
     * @return Total
     */
    private function getTotalProducto($ProductoId, $Cantidad)
    {
        $PrecioVenta = 0;
        $Consulta = Producto::select(['PrecioVenta'])
        ->where('ProductoId', '=', $ProductoId)->get();

        foreach($Consulta as $item){
            $PrecioVenta = $item->PrecioVenta;
        }

        $IntPrecioVenta = intval($PrecioVenta);
        $IntCantidad = intval($Cantidad);

        $Total = $IntPrecioVenta * $IntCantidad;
        return $Total;
    }

    private function getSubTotalProducto($Total)
    {
        $SubTotal = $Total - ($Total * 0.19);
        return $SubTotal;
    }

    public function addProducto(Request $request)
    {

        // Definir variables
        $VentaSession = [];
        $Articulos = [];
        $VentaData = [];
        $Total = 0;
        $SubTotal = 0;

        // Rescatar ID y Cantidad
        $ProductoId = json_decode($request->ProductoId);
        $Orden = json_decode($request->Orden);

        // Determinar total y subtotal para el producto
        $PrecioTotalProducto = $this->getTotalProducto($ProductoId, $Orden);
        $SubTotalProducto = $this->getSubTotalProducto($PrecioTotalProducto);

        try {
            if (session()->exists('VentaSession')) {
                // Rescatando datos de la sesión
                $VentaSession = session()->pull('VentaSession');
                $Articulos = $VentaSession['Articulos'];
                $VentaData = $VentaSession['VentaData'];

                // Rescatando total y subtotal general
                $Total = $VentaData['Total'];
                $SubTotal = $VentaData['SubTotal'];

                // Recalculando total y subtotal general
                $Total += intval($PrecioTotalProducto);
                $SubTotal += intval($SubTotalProducto);

                // Reemplazando total y subtotal general & Agregando producto
                $VentaData = array_replace($VentaData, ['Total' => $Total, 'SubTotal' => $SubTotal]);
                array_push($Articulos, [$ProductoId => ['Orden' => $Orden, 'Total' => $PrecioTotalProducto, 'SubTotal' => $SubTotalProducto]]);

                // Reemplazando VentaData y Articulos
                $VentaSession = array_replace($VentaSession, ['Articulos' => $Articulos, 'VentaData' => $VentaData]);
                session(['VentaSession' => $VentaSession]);

                return $VentaSession;
            }
        } catch (\Throwable $th) {
            return $th;
        }

        try {
            // Adición del primer producto
            $Total += intval($PrecioTotalProducto);
            $SubTotal += intval($SubTotalProducto);

            // Guardando total y subtotal general & Agregando producto
            array_push($VentaData, ['Total' => $Total, 'SubTotal' => $SubTotal]);
            array_push($Articulos, [$ProductoId => ['Orden' => $Orden, 'Total' => $PrecioTotalProducto, 'SubTotal' => $SubTotalProducto]]);

            // Guardando VentaData y Articulos
            array_push($VentaSession, ['Articulos' => $Articulos, 'VentaData' => $VentaData]);
            session(['VentaSession' => $VentaSession]);

            return session()->all();
        } catch (\Throwable $th) {
            return $th;
        } 

        // $Articulos = ['100' => 'Zapatos', '101' => 'Medias', '102' => 'Camiseta'];
        // $VentaData = ['Cliente' => 'Armadillo Perez', 'Documento' => 1000919533];
        // array_push($VentaSession, ['Articulos' => $Articulos]);
        // array_push($VentaSession, ['VentaData' => $VentaData]);

    }

    public function getArray(Request $request)
    {
        $numero = $request->numero;
        $info = array(['David', 17]);
        array_push($info, ['Nombre' => 'Juan', 'Edad' => 15]);
        return json_encode($info);
    }
}
