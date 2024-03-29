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
    public function index($status = null)
    {

        $programaciones = Programacion::select(['ProgramacionId','sedes.NombreSede','grupos.NombreGrupo','horarios.NombreHorario','FechaInicio','FechaFinalizacion','programacion.Estado'])
        ->join('sedes','sedes.SedeId','=','Programacion.SedeId')
        ->join('grupos','grupos.GrupoId','=','Programacion.GrupoId')
        ->join('horarios','horarios.HorarioId','=','Programacion.HorarioId')
        ->orderbydesc('ProgramacionId')->get();

        $sedes = Sede::select(['SedeId','NombreSede'])->where('Estado','=',true)->get();
        $deportes = Deporte::select(['DeporteId','NombreDeporte'])->where('Estado','=',true)->get();
        $horarios = Horario::select(['HorarioId','NombreHorario','HoraInicio','HoraFinalizacion'])->where('Estado','=',true)->get();
        $progData = ['sedes'=>$sedes, 'horarios'=>$horarios, 'deportes'=>$deportes, 'horarios'=>$horarios,'programaciones'=>$programaciones];

        switch($status){
            case 1:
                $sweet_setAll = ['title'=>'Registro guardado', 'msg'=>'El registro se guardó exitosamente', 'type'=>'success'];
                return view('Programacion.Programaciones')->with('progData',$progData)->with('sweet_setAll',$sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title'=>'Registro editado', 'msg'=>'El registro se editó exitosamente', 'type'=>'success'];
                return view('Programacion.Programaciones')->with('progData',$progData)->with('sweet_setAll',$sweet_setAll);
                break;
            default:
            return view('Programacion.Programaciones')->with('progData',$progData);
            break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),
        ['GrupoId'=>'required',
        'SedeId'=>'required',
        'HorarioId'=>'required',
        'FechaInicio'=>'required',
        'FechaFinalizacion'=>'required'],
        ['required'=>'Evite enviar el campo vacío']);

        if($validator->fails()){
            return redirect('programacion/listar')->withErrors($validator)->withInput();
        }

        $campos = ['SedeId','GrupoId','HorarioId','FechaInicio','FechaFinalizacion'];
        $programacion = new Programacion();
        $ProgramacionId = Programacion::creadorPK($programacion,1000);
        $programacion->ProgramacionId = $ProgramacionId;

        foreach ($campos as $item) {
            $programacion->$item = $request->$item;
        }
        
        $programacion->save();
        return redirect('programacion/listar/1');
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
}
