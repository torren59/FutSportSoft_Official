<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Categoria;
use App\Models\Programacion\Deporte;
use App\Models\Programacion\Grupo;
use App\Rules\noRepeatDeportes;
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
    public function index($status = null)
    {
        $Deporte = new Deporte();
        $ListadoDeporte = $Deporte->all();
        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('Programacion.deportes')->with('listado', $ListadoDeporte)->with('sweet_setAll', $sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title' => 'Registro editado', 'msg' => 'El registro se editó exitosamente', 'type' => 'success'];
                return view('Programacion.deportes')->with('listado', $ListadoDeporte)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
                return view('Programacion.deportes')->with('listado', $ListadoDeporte);
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
        $validator = Validator::make(
            $request->all(),
            ['NombreDeporte' => 'unique:deportes,NombreDeporte|min:1|max:50'],
            ['unique' => 'Deporte ya se encuentra registrado el sistema', 'min' => 'No es posible enviar este campo vacío', 'max' => 'Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return redirect('deporte/listar')->withErrors($validator);
        }

        $Deporte = new Deporte();
        $Id = $Deporte::creadorPK($Deporte, 10);
        $Deporte->DeporteId = $Id;
         $Deporte->NombreDeporte =$request->NombreDeporte;
        // strtoupper($request->NombreDeporte);
        $Deporte->save();

        return redirect('deporte/listar/1');
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
        $Selected =  Deporte::all()->where('DeporteId', '=', $id);
        return view('Programacion.editardeporte')->with('deportedata', $Selected);
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
        $request['DeporteId'] = $id;
        $validator = Validator::make(
            $request->all(),
            ['NombreDeporte' => ['min:1',new noRepeatDeportes,'max:50']],
            ['unique' => 'Deporte ya se encuentra registrado el sistema', 'min' => 'No es posible enviar este campo vacío', 'max' => 'Máximo de :max dígitos']
        );
        session()->forget('DeporteId');
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $deporte = Deporte::find($id);
        $deporte->NombreDeporte = $request->NombreDeporte;
        // strtoupper($request->NombreDeporte);
        $deporte->save();
        return redirect('deporte/listar/2');
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

    public function getcategorias(Request $request)
    {
        $DeporteId = $request->DeporteId;
        $categorias = Categoria::select(['CategoriaId', 'NombreCategoria'])->where('DeporteId', '=', $DeporteId)->get();
        return json_encode($categorias);
    }

    public function getgrupos(Request $request)
    {
        $CategoriaId = $request->CategoriaId;
        $grupos = Grupo::select(['GrupoId', 'NombreGrupo'])->where('CategoriaId', '=', $CategoriaId)->get();
        return json_encode($grupos);
    }

    public function canChange(Request $request)
    {
        $DeporteId = json_decode($request->DeporteId);
        $deportes = Deporte::select(['categorias.CategoriaId', 'deportes.NombreDeporte'])
            ->join('categorias', 'deportes.DeporteId', '=', 'categorias.DeporteId')
            ->where('deportes.DeporteId', '=', intval($DeporteId))
            ->where('categorias.Estado', '=', true)
            ->get();
        return json_encode($deportes);
    }

    public function changeState(Request $request)
    {
        $DeporteId = json_decode($request->DeporteId);
        $deporte = Deporte::find($DeporteId);

        if ($deporte->Estado == false) {
            $deporte->Estado = true;
        } else {
            $deporte->Estado = false;
        }
        $deporte->save();

        $Estado = ['Estado' => $request->Estado];
        return json_encode($Estado);
    }
}
