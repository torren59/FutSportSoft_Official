<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Deporte;
use App\Models\Programacion\Grupo;
use App\Models\Programacion\Grupos;
use App\Models\Programacion\Horario;
use App\Models\Programacion\Programacion;
use App\Models\Programacion\Sede;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProgramacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $programaciones = Programacion::select(['ProgramacionId','sedes.NombreSede','grupos.NombreGrupo','horarios.Horario','FechaInicio','FechaFinalizacion','programacion.Estado'])
        ->join('sedes','sedes.SedeId','=','Programacion.SedeId')
        ->join('grupos','grupos.GrupoId','=','Programacion.GrupoId')
        ->join('horarios','horarios.HorarioId','=','Programacion.HorarioId')
        ->orderbydesc('ProgramacionId')->get();

        $sedes = Sede::all(['SedeId','NombreSede']);
        $deportes = Deporte::all(['DeporteId','NombreDeporte']);
        $horarios = Horario::all(['HorarioId','NombreHorario','Horario']);
        $progData = ['sedes'=>$sedes, 'horarios'=>$horarios, 'deportes'=>$deportes, 'horarios'=>$horarios,'programaciones'=>$programaciones];
        return view('Programacion.Programaciones')->with('progData',$progData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),['GrupoId'=>'required','SedeId'=>'required','HorarioId'=>'required','FechaInicio'=>'required','FechaFinalizacion'=>'required'],
        ['required'=>'Evite enviar el campo vacío']);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $campos = ['SedeId','GrupoId','HorarioId','FechaInicio','FechaFinalizacion'];
        $programacion = new Programacion();
        $ProgramacionId = Programacion::creadorPK($programacion,1000);
        $programacion->ProgramacionId = $ProgramacionId;
        foreach ($campos as $item) {
            $programacion->$item = $request->$item;
        }
        $programacion->save();
        return redirect('programacion/listar');
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

    public function changeState(Request $request){
        $progId = json_decode($request->progId);
        $Programacion = Programacion::find($progId);
        
        if($Programacion->Estado == true){
            $Programacion->Estado = false;
        }
        else{
            $Programacion->Estado = true;
        }

        $Programacion->save();

        return json_encode($Programacion);

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
