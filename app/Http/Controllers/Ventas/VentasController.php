<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Compras\articulo_comprado;
use App\Models\Compras\Producto;
use App\Models\Programacion\Deporte;
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
        return view('Ventas.ventas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ProductModel = new Producto();
        $Productos = $ProductModel->all();
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

        return redirect('dashboard/panel');
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

    public function getArray(Request $request){
        $numero = $request->numero;
        $info = array(['David',17]);
        array_push($info,['Nombre'=>'Juan','Edad'=>15]);
        return json_encode($info);
    }
}
