<?php
namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Sede;
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
        $validator = Validator::make($request->all(), 
        ['NombreSede'=>'min:1|unique:sedes,NombreSede','Municipio'=>'min:1','Barrio'=>'min:1','Direccion'=>'min:1|unique:sedes,Direccion'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío']);
        $NombreSede = $request->old('NombreSede');
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $Sede = new Sede();
        $id = $Sede::creadorPK($Sede,100);
        $Sede->SedeId = $id;
        $Campos = ['NombreSede','Municipio','Barrio','Direccion'];

        foreach($Campos as $item){
            $Sede->$item = $request->$item;
        }

        $Sede->save();
        return redirect('sede/listar');

        // $Sede->NombreSede = $request->NombreSede;
        // $Sede->Municipio = $request->Municipio;
        // $Sede->Barrio = $request->Barrio;
        // $Sede->Direccion = $request->Direccion;

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
