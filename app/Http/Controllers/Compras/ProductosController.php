<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Compras.productos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = Validator::make($request->all(), 
        ['Nit'=>'min:1|unique:productos,Nit|max:11','NombreProducto'=>'min:1|max:100','TipoProducto'=>'min:1|max:2','Talla'=>'min:1|max:6','PrecioVenta'=>'min:1|max:8','Cantidad'=>'min:1|max:4'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        // ,'Municipio'=>70,'Barrio'=>70,'Direccion'=>100
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $Producto = new Producto();
        $id = $Producto::creadorPK($Producto,100000);
        $Producto->ProductoId = $id;
        $Campos = ['Nit','NombreProducto','TipoProducto','Talla','PrecioVenta','Cantidad'];
        foreach($Campos as $item){
            $Producto->$item = $request->$item;
        }

        $Producto->save();
        return redirect('Producto/listar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
