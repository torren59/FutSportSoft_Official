<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\articulo_comprado;
use App\Models\Compras\Compras;
use App\Models\Compras\Producto;
use App\Models\Programacion\Deporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ListadoCompras = Compras::all();
        return view('Compras.compras')->with('listado', $ListadoCompras);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $ProductModel= new Producto();
        $Productos = $ProductModel->all();
        return view('Compras.crearcompra')->with('productos',$Productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        ['NumeroFactura'=>'min:1|unique:compras,NumeroFactura|max:20','Nit'=>'min:1|max:12','FechaCompra'=>'min:1|max:20','ValorCompra'=>'min:1||max:20','SubTotal'=>'min:1||max:20','Iva'=>'min:1||max:20','Descuento'=>'min:1||max:20'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $Compras = new Compras();
        $Compras->NumeroFactura = $request->NumeroFactura;
        $Campos = ['NumeroFactura','Nit','FechaCompra','FechaCompra','ValorCompra','SubTotal','Iva','Descuento'];
        foreach($Campos as $item){
            $Compras->$item = $request->$item;
        }

        $Compras->save();
        // return redirect('compras/listar');

        $productos = $request->productos;
        $articulosComprados = [];

        if($productos == null){
            return 'Evite enviar productos vacío';
        }

        foreach($productos as $item){
            // Crea las rutas para rescatar datos del request
            $rutaCantidad = strval($item.'_cantidad');
            $rutaValorUnitario = strval($item.'_unitValue');

            // Llena el objeto con los datos de un producto adicionado
            $articulos = new articulo_comprado();
            $articulos->ProductoId = $item;
            $articulos->Cantidad = $request->$rutaCantidad;
            $articulos->PrecioCompra = $request->$rutaValorUnitario;

            // Llena el array de validable con los datos del objeto
            $validable = ['ProductoId'=>$item, 'Cantidad' => $request->$rutaCantidad, 'PrecioCompra' => $request->$rutaValorUnitario];

            // Valida que el objeto no tenga campos vacíos
            $validator = Validator::make($validable,
            ['Cantidad'=>'required|min:1','PrecioCompra'=>'required|min:0']);
            if($validator->fails()){
                return back()
                ->withErrors($validator)
                ->withInput();
            }

            // Guarda Objeto en array si este pasa la validación
            array_push($articulosComprados,$articulos);
        }



        foreach($articulosComprados as $item){
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

        return redirect('compras/listar');
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
       //
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
       //
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

    public function getDetalle(Request $request){
        $NumeroFactura = $request->NumeroFactura;
        $compraArticulos = [];


        $Compra = Compras::select(['NumeroFactura','proveedores.NombreEmpresa','FechaCompra','ValorCompra','SubTotal','IVA','Descuento','compras.Estado'])
        ->join('proveedores','proveedores.Nit','=','compras.Nit')
        ->where('NumeroFactura','=',$NumeroFactura)
        ->get();

        $Articulos = articulo_comprado::select(['productos.NombreProducto','productos.Talla','articulos_comprados.Cantidad','PrecioCompra'])
        ->join('productos','productos.ProductoId','=','articulos_comprados.ProductoId')
        ->where('NumeroFactura','=',$NumeroFactura)
        ->get(); 

        array_push($compraArticulos,$Compra,$Articulos);

        return $compraArticulos;

    }
}
