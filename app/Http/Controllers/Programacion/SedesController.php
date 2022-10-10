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
        $ListadoSede = Sede::all();
        return view('Programacion.Sedes')->with('listado', $ListadoSede);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['NombreSede' => 'min:1|unique:sedes,NombreSede|max:50', 'Municipio' => 'min:1|max:70', 'Barrio' => 'min:1|max:70', 'Direccion' => 'min:1|unique:sedes,Direccion|max:100'],
            ['unique' => 'Este campo no acepta información que ya se ha registrado', 'min' => 'No puedes enviar este campo vacío', 'max' => 'Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $Sede = new Sede();
        $id = $Sede::creadorPK($Sede, 100);
        $Sede->SedeId = $id;
        $Campos = ['NombreSede', 'Municipio', 'Barrio', 'Direccion'];
        foreach ($Campos as $item) {
            $Sede->$item = $request->$item;
        }

        $Sede->save();
        return redirect('sede/listar');
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
        $Selected =  Sede::all()->where('SedeId', '=', $id);
        return view('Programacion.editarsede')->with('sededata', $Selected);
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

        $validator = Validator::make(
            $request->all(),
            ['NombreSede' => 'min:1', 'Municipio' => 'min:1|max:70', 'Barrio' => 'min:1|max:70', 'Direccion' => 'min:1|max:100'],
            ['unique' => 'Este campo no acepta información que ya se ha registrado', 'min' => 'No puedes enviar este campo vacío', 'max' => 'Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $sede = Sede::find($id);
        $Campos = ['NombreSede', 'Municipio', 'Barrio', 'Direccion'];
        foreach ($Campos as $item) {
            $sede->$item = $request->$item;
        }
        $sede->save();
        return redirect('sede/listar');
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
