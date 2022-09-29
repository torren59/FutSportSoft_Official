<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Categorias;
use App\Models\Programacion\Deporte;
use App\Models\Programacion\Grupos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class DeportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Deporte = new Deporte();
        $ListadoDeporte = $Deporte->all();
        return view('Programacion.deportes')->with('listado',$ListadoDeporte);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make( $request->all(), ['NombreDeporte'=>'unique:deportes,NombreDeporte|min:1|max:50'],
        ['unique'=>'Deporte ya se encuentra registrado el sistema','min'=>'No es posible enviar este campo vacío','max'=>'Máximo de :max dígitos']);
    
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $Deporte = new Deporte();
        $Id = $Deporte::creadorPK($Deporte,10);
        $Deporte->DeporteId = $Id;
        $Deporte->NombreDeporte = strtoupper($request->NombreDeporte);
        $Deporte->save();

        return redirect('deporte/listar');
        
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
        $Selected =  Deporte::all()->where('DeporteId','=',$id);
        return view('Programacion.editardeporte')->with('deportedata',$Selected);
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
        $validator = Validator::make( $request->all(), ['NombreDeporte'=>'unique:deportes,NombreDeporte|min:1|max:50'],
        ['unique'=>'Deporte ya se encuentra registrado el sistema','min'=>'No es posible enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $deporte = Deporte::find($id);
        $deporte->NombreDeporte = strtoupper($request->NombreDeporte);
        $deporte->save();
        return redirect('deporte/listar');
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

    public function getcategorias(Request $request){
        $DeporteId = $request->DeporteId;
        $categorias = Categorias::select(['CategoriaId','NombreCategoria'])->where('DeporteId','=',$DeporteId)->get();
        return json_encode($categorias);   
    }

    public function getgrupos(Request $request){
        $CategoriaId = $request->CategoriaId;
        $grupos = Grupos::select(['GrupoId','NombreGrupo'])->where('CategoriaId','=',$CategoriaId)->get();
        return json_encode($grupos);   
    }
}
