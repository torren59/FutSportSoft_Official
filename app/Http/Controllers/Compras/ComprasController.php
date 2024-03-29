<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\articulo_comprado;
use App\Models\Compras\Compras;
use App\Models\Compras\Producto;
use App\Models\Compras\Proveedor;
use App\Models\Programacion\Deporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;
use Symfony\Component\Console\Input\Input;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        session()->forget('NitProveedor');
        $ListadoCompras = Compras::select(['NumeroFactura', 'proveedores.NombreEmpresa', 'FechaCompra', 'ValorCompra', 'SubTotal', 'Iva', 'Descuento', 'compras.Estado'])
            ->join('proveedores', 'compras.Nit', '=', 'proveedores.Nit')->get();
        $ListadoProveedor = Proveedor::all()->where('Estado','=',true);
        $Listados = ['ListadoCompras' => $ListadoCompras, 'ListadoProveedor' => $ListadoProveedor];


        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('Compras.compras')->with('listado', $Listados)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
                return view('Compras.compras')->with('listado', $Listados);
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request, $status = null)
    {
        $Nit = 0;
        if ($request->session()->exists('NitProveedor')) {
            $Nit = session('NitProveedor');
        } else if (isset($request->Nit)) {
            $Nit = $request->Nit;
            session(['NitProveedor' => $Nit]);
        }
        $ListadoProveedor = Proveedor::select(['Nit', 'NombreEmpresa'])->where('Nit', '=', $Nit)->get();
        $Listados = ['ListadoProveedor' => $ListadoProveedor];
        $ProductModel = new Producto();
        $Productos = $ProductModel->select()->where('Nit', '=', $Nit)->get();


        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'No has seleccionado ningun producto', 'msg' => 'Evita enviar productos vacios', 'type' => 'warning'];
                return view('Compras.crearcompra')->with('productos', $Productos)->with('listado', $Listados)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
                return view('Compras.crearcompra')->with('productos', $Productos)->with('listado', $Listados);
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['NumeroFactura' => 'min:1|unique:compras,NumeroFactura|max:20', 'Nit' => 'min:1|max:12', 'FechaCompra' => 'min:1|max:20', 'ValorCompra' => 'min:1||max:20', 'SubTotal' => 'min:1||max:20', 'Iva' => 'min:1||max:20',],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return redirect('compras/crearproveedor')->withErrors($validator)->withInput();
        }
        $productos = $request->productos;
        if ($productos == null) {
            return redirect('compras/crearproveedor/1')->withInput();
        }
        $Compras = new Compras();
        $Compras->NumeroFactura = $request->NumeroFactura;
        $Campos = ['NumeroFactura', 'Nit', 'FechaCompra', 'FechaCompra', 'ValorCompra', 'SubTotal', 'Iva', 'Descuento'];
        foreach ($Campos as $item) {
            $Compras->$item = $request->$item;
        }

        $Compras->save();
        // return redirect('compras/listar');


        $articulosComprados = [];


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
                return redirect('compras/crearproveedor')
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
            $producto = Producto::find($item->ProductoId);
            $Cantidad = $producto->Cantidad + $item->Cantidad;
            $producto->Cantidad = $Cantidad;
            $producto->save();
        }
        session()->forget('NitProveedor');
        return redirect('compras/listar/1');
    }


    public function listselected(Request $request)

    {
        $ProductModel = new Producto();
        $Selecteds = json_decode($request->seleccionados);
        $checkeds = $ProductModel->whereIn('ProductoId', $Selecteds)->select('ProductoId', 'NombreProducto', 'TipoProducto', 'Talla', 'Cantidad')->get();
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

   public function canChange(Request $request){
    $CompraId = json_decode($request->CompraId);
    $articulos = articulo_comprado::select(['ProductoId','Cantidad'])->where('NumeroFactura','=',$CompraId)->get();
    $sinExistencias = [];

    foreach($articulos as $articulo){
        $producto = Producto::find($articulo->ProductoId);
        if(intval($producto->Cantidad)<intval($articulo->Cantidad)){
            $insuficiente = ['ProductoId'=>$producto->ProductoId ,'NombreProducto'=>$producto->NombreProducto ,'Cantidad'=>$producto->Cantidad];
            array_push($sinExistencias,$insuficiente);
        }
    }

    $Estado = true;

    if(sizeof($sinExistencias)>0){
        $Estado = false;
    }

    $resultado = ['Estado'=>$Estado,'ausencias' => $sinExistencias];

    return json_encode($resultado);
   }

    public function getDetalle(Request $request)
    {
        $NumeroFactura = $request->NumeroFactura;
        $compraArticulos = [];


        $Compra = Compras::select(['NumeroFactura', 'proveedores.NombreEmpresa', 'FechaCompra', 'ValorCompra', 'SubTotal', 'Iva', 'Descuento', 'compras.Estado'])
            ->join('proveedores', 'proveedores.Nit', '=', 'compras.Nit')
            ->where('NumeroFactura', '=', $NumeroFactura)
            ->get();



        $Articulos = articulo_comprado::select(['productos.NombreProducto', 'productos.Talla', 'articulos_comprados.Cantidad', 'PrecioCompra'])
            ->join('productos', 'productos.ProductoId', '=', 'articulos_comprados.ProductoId')
            ->where('NumeroFactura', '=', $NumeroFactura)
            ->get();

        array_push($compraArticulos, $Compra, $Articulos);

        return $compraArticulos;
    }

    public function changeState(Request $request)
    {
        $NumeroFactura = json_decode($request->NumeroFactura);
        $Compra = Compras::find($NumeroFactura);

        if ($Compra->Estado == true) {
            $Compra->Estado = false;
        } else {
            $Compra->Estado = true;
        }

        $Compra->save();

        $articulos = articulo_comprado::select(['ProductoId','Cantidad'])->where('NumeroFactura','=',$NumeroFactura)->get();

        foreach($articulos as $articulo){
            $producto = Producto::find($articulo->ProductoId);
            $cantidadInicial = $producto->Cantidad;
            $nuevaCantidad = intval($cantidadInicial) - intval($articulo->Cantidad);
            $producto->Cantidad = $nuevaCantidad;
            $producto->save();
        }

        return json_encode($Compra);
    }
}

