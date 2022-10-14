<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Compras\Producto;
use App\Models\Ventas\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

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
        return view('Ventas.ventas')->with('listado',$ListadoVenta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $validator = Validator::make($request->all(), 
         ['Documento'=>'min:1|unique:ventas,Documento|max:11','FechaVenta'=>'min:1|max:20','ValorVenta'=>'min:1|max:20','SubTotal'=>'min:1|unique:ventas,SubTotal|max:20','IVA'=>'min:1|max:20','Descuento'=>'min:1|max:20'],
         ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        
         if($validator->fails()){
             return back()->withErrors($validator)->withInput();
         }
         $Venta = new Venta();
         $id = $Venta::creadorPK($Venta,100);
         $Venta->VentaId = $id;
         $Campos = ['Documento','FechaVenta','ValorVenta','SubTotal','IVA','Descuento'];
         foreach($Campos as $item){
             $Venta->$item = $request->$item;
         }

         $Venta->save();
         return redirect('venta/listar');
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


    public function listselected(Request $request){
        $ProductModel = new Producto(); 
        $Selecteds = json_decode($request->seleccionados);
        $checkeds = $ProductModel->whereIn('ProductoId',$Selecteds)->select('NombreProducto')->get();
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
        $Selected =  Venta::all()->where('VentaId','=',$id);
        return view('Ventas.editarventas')->with('ventadata',$Selected);
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
        ['Documento'=>'min:1|unique:ventas,Documento|max:11','FechaVenta'=>'min:1|max:20','ValorVenta'=>'min:1|max:20','SubTotal'=>'min:1|unique:ventas,SubTotal|max:20','IVA'=>'min:1|max:20','Descuento'=>'min:1|max:20'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
            
        }
        $venta = Venta::find($id);
        $Campos = ['Documento','FechaVenta','ValorVenta','SubTotal','IVA','Descuento'];
        foreach($Campos as $item){
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
}
