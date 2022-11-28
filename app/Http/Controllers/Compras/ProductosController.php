<?php

namespace App\Http\Controllers\Compras;

use App\Models\Compras\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::select(['ProductoId','tallas.Talla'])
        ->join('tallas','tallas.TallaId','=','Producto.TallaId')

        $Producto = new Producto();
        $ListadoProducto = $Producto->all();
        return view('Compras.productos')->with('listado',$ListadoProducto);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        return redirect('producto/listar');
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
        $Selected =  Producto::all()->where('ProductoId','=',$id);
        return view('Compras.editarproducto')->with('productodata',$Selected);
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
        $validator = Validator::make($request->all(), 
        ['Nit'=>'min:1|max:11','NombreProducto'=>'min:1|max:100','TipoProducto'=>'min:1|max:2','Talla'=>'min:1|max:6','PrecioVenta'=>'min:1|max:8','Cantidad'=>'min:1|max:4'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        // ,'Municipio'=>70,'Barrio'=>70,'Direccion'=>100
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        
        }
        $Producto = Producto::find($id);
        $Campos = ['Nit','NombreProducto','TipoProducto','Talla','PrecioVenta','Cantidad'];
        foreach($Campos as $item){
            $Producto->$item = $request->$item;
        }
        $Producto->save();
        return redirect('producto/listar');
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
