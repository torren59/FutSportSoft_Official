<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Categoria;
use App\Models\Programacion\Deporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {

        $ListadoCategoria = Categoria::select(['CategoriaId', 'NombreCategoria', 'deportes.NombreDeporte', 'RangoEdad', 'categorias.Estado'])
            ->join('deportes', 'categorias.DeporteId', '=', 'deportes.DeporteId')
            ->get();
        $ListadoDeporte = Deporte::all();
        $Listados = ['ListadoCategoria' => $ListadoCategoria, 'ListadoDeporte' => $ListadoDeporte];


        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('Programacion.Categoria')->with('listado', $Listados)->with('sweet_setAll', $sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title' => 'Registro editado', 'msg' => 'El registro se editó exitosamente', 'type' => 'success'];
                return view('Programacion.Categoria')->with('listado', $Listados)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
            return view('Programacion.Categoria')->with('listado', $Listados);
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
            ['NombreCategoria' => 'min:1|unique:categorias,NombreCategoria|max:50', 'DeporteId' => 'min:1|max:50|required', 'RangoEdad' => 'min:1|max:30'],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return redirect('categoria/listar')->withErrors($validator)->withInput();
        }
        $Categoria = new Categoria();
        $id = $Categoria::creadorPK($Categoria, 100);
        $Categoria->CategoriaId = $id;
        $Campos = ['NombreCategoria', 'DeporteId', 'RangoEdad'];
        foreach ($Campos as $item) {
            $Categoria->$item = $request->$item;
        }

        $Categoria->save();
        return redirect('categoria/listar/1');
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
        $Selected =  Categoria::select(['categorias.CategoriaId', 'deportes.DeporteId', 'deportes.NombreDeporte', 'NombreCategoria', 'RangoEdad'])
            ->join('deportes', 'categorias.DeporteId', '=', 'deportes.DeporteId')->where('categorias.CategoriaId', '=', $id)
            ->get();
        $Deporte = Deporte::select(['DeporteId', 'NombreDeporte'])->get();
        $data = ['categorias' => $Selected, 'deportes' => $Deporte];
        return view('Programacion.editarcategoria')->with('data', $data);

    }

    public function changeState(Request $request)
    {
        $CategoriaId = json_decode($request->CategoriaId);
        $Categoria = Categoria::find($CategoriaId);

        if ($Categoria->Estado == false) {
            $Categoria->Estado = true;
        } else {
            $Categoria->Estado = false;
        }
        $Categoria->save();

        $Estado = ['Estado' => $request->Estado];
        return json_encode($Estado);
    }

    public function canChange(Request $request)
    {
        $CategoriaId = json_decode($request->CategoriaId);
        $Categoria = Categoria::select(['grupos.GrupoId', 'categorias.NombreCategoria'])
            ->join('grupos', 'categorias.CategoriaId', '=', 'grupos.CategoriaId')
            ->where('categorias.CategoriaId', '=', intval($CategoriaId))
            ->where('grupos.Estado', '=', true)
            ->get();

        return json_encode($Categoria);
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
            ['NombreCategoria' => 'min:1|unique:categorias,NombreCategoria|max:50', 'DeporteId' => 'max:50|required', 'RangoEdad' => 'min:1|max:30'],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $Categoria = Categoria::find($id);
        $Campos = ['DeporteId', 'NombreCategoria', 'RangoEdad'];
        foreach ($Campos as $item) {
            $Categoria->$item = $request->$item;
        }
        $Categoria->save();
        return redirect('categoria/listar/2');
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
