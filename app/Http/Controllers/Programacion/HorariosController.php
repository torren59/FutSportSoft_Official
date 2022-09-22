<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ListadoHorario = Horario::all();
        return view('Programacion.Horarios')->with('listado',$ListadoHorario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),
        ['NombreHorario'=>'min:1|max:50','Horario'=>'min:1|max:20'],
        ['min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $Horario = new Horario();
        $id = $Horario::creadorPK($Horario,10000);
        $Horario->HorarioId = $id;
        $Campos = ['NombreHorario','Horario'];

        foreach($Campos as $item){
            $Horario->$item = $request->$item;
        }

        $Horario->save();
        return redirect('horario/listar');
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
        $Selected =  Horario::all()->where('HorarioId','=',$id);
        return view('Programacion.editarhorario')->with('horariodata',$Selected);
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
        ['NombreHorario'=>'min:1|max:50','Horario'=>'min:1|max:20'],
        ['min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $horario = Horario::find($id);
        $Campos = ['NombreHorario','Horario'];

        foreach($Campos as $item){
            $horario->$item = $request->$item;
        }

        $horario->save();
        return redirect('horario/listar');
        
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
