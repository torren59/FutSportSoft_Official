<?php
namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SedesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Programacion.Sedes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), ['Nombre'=>'min:1|unique:sedes,NombreSede']);
        // $validdator = Validator::make( $request->all(), ['NombreDeporte'=>'unique:deportes,NombreDeporte'],
        // ['unique'=>'Deporte ya se encuentra registrado el sistema']);
    
        // if($validator->fails()){
        //     return back()->withErrors($validator);
        // }

        // $Deporte = new Deporte();
        // $Id = $Deporte::creadorPK($Deporte,10);
        // $Deporte->DeporteId = $Id;
        // $Deporte->NombreDeporte = $request->NombreDeporte;
        // $Deporte->save();

        // return redirect('deporte/listar');
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
