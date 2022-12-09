<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Grupos;
use App\Models\Programacion\Categoria;
use App\Models\Programacion\Deportista;
use App\Models\Programacion\Grupo;
use App\Models\Programacion\Grupos_Deportistas;
use App\Models\User;
use App\Rules\noRepeatGrupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $ListadoGrupos = Grupos::select(['GrupoId', 'categorias.NombreCategoria', 'users.Nombre', 'NombreGrupo', 'grupos.Estado'])
            ->join('users', 'grupos.Documento', '=', 'users.Documento')
            ->join('categorias', 'grupos.CategoriaId', '=', 'categorias.CategoriaId')
            ->get();
        $ListadoCategoria = Categoria::all();
        $ListadoUsuario = User::all();
        $Deportista = Deportista::select(['Documento', 'Nombre', 'FechaNacimiento'])->get();
        $Listados = ['ListadoGrupos' => $ListadoGrupos, 'ListadoCategoria' => $ListadoCategoria, 'ListadoUsuario' => $ListadoUsuario];


        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('Programacion.grupos')->with('listado', $Listados)->with('deportistas_crear', $Deportista)->with('sweet_setAll', $sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title' => 'Registro editado', 'msg' => 'El registro se editó exitosamente', 'type' => 'success'];
                return view('Programacion.grupos')->with('listado', $Listados)->with('deportistas_crear', $Deportista)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
            return view('Programacion.grupos')->with('listado', $Listados)->with('deportistas_crear', $Deportista);
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
            ['NombreGrupo' => 'min:1|unique:grupos,NombreGrupo|max:50', 'CategoriaId' => 'numeric|max:50', 'Documento' => 'numeric'],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos', 'numeric'=>'* Selecciona alguna opción']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $Grupos = new Grupo();
        $GrupoId = $Grupos::creadorPK($Grupos, 100);
        $Grupos->GrupoId = $GrupoId;
        $Campos = ['CategoriaId', 'Documento', 'NombreGrupo'];
        foreach ($Campos as $item) {
            $Grupos->$item = $request->$item;
        }

        $Grupos->save();



        $Deportista = $request->deportistas;

        if ($Deportista == null) {
            return redirect('grupos/listar/1');
        }


        foreach ($Deportista as $item) {

            // Llena el objeto con los datos de un producto adicionado
            $Adicionados = new Grupos_Deportistas();
            $Adicionados->Documento = $item;
            $Adicionados->GruposDeportistasId = Grupos_Deportistas::creadorPK($Adicionados, 100);
            $Adicionados->GrupoId = $GrupoId;
            $Adicionados->FechaIngreso =  date('Y-m-d');
            $Adicionados->save();
        }

        return redirect('grupos/listar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    public function edit($GrupoId)
    {
        $Selected =  Grupos::select(['NombreGrupo', 'GrupoId', 'categorias.CategoriaId', 'categorias.NombreCategoria', 'users.Documento', 'users.Nombre'])
            ->join('categorias', 'categorias.CategoriaId', '=', 'grupos.CategoriaId')
            ->join('users', 'users.Documento', '=', 'grupos.Documento')->where('GrupoId', '=', $GrupoId)->get();

        $Deportistas_total = Deportista::all();
        $Categorias_total = Categoria::all();
        $Usuarios_total = User::all();
        $deportistasdelgrupo = Grupo::select(['deportistas.Documento'])
            ->join('grupos_deportistas', 'grupos_deportistas.GrupoId', '=', 'grupos.GrupoId')
            ->join('deportistas', 'grupos_deportistas.Documento', '=', 'deportistas.Documento')
            ->where('grupos.GrupoId', '=', $GrupoId)
            ->get();




        $deportistas_seleccionados = [];
        foreach ($deportistasdelgrupo as $item) {
            array_push($deportistas_seleccionados, $item->Documento);
        }

        return view('Programacion.editargrupos')->with('total_categorias', $Categorias_total)->with('deportistas_crear', $Deportistas_total)->with('grupodata', $Selected)
            ->with('deportistas_checked', $deportistas_seleccionados)->with('total_usuarios', $Usuarios_total);

        // return $Categorias_total;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            ['NombreGrupo' => ['min:1',new noRepeatGrupos,'max:50'], 'CategoriaId' => 'min:1|max:50', 'Documento' => 'min:1|max:50'],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $GrupoId = $request->IdGrupo;
        $Grupos = Grupo::find($GrupoId);
        $Campos = ['CategoriaId', 'Documento', 'NombreGrupo'];

        foreach ($Campos as $item) {
            $Grupos->$item = $request->$item;
        }
        $Grupos->save();


        $Deportistasenviados = $request->chequeados;
        if($Deportistasenviados == null){
            $Deportistasenviados = [];
        }

        $deportistasdelgrupo = Grupo::select(['deportistas.Documento'])
            ->join('grupos_deportistas', 'grupos_deportistas.GrupoId', '=', 'grupos.GrupoId')
            ->join('deportistas', 'grupos_deportistas.Documento', '=', 'deportistas.Documento')
            ->where('grupos.GrupoId', '=', $GrupoId)
            ->get();

        $Registrados = [];
        if(sizeof($deportistasdelgrupo) > 0){
            foreach ($deportistasdelgrupo as $item) {
                array_push($Registrados, $item->Documento);
            }
        }



        $Deportistasnuevos = [];
        if (sizeof($Deportistasenviados) > 0 && sizeof($Registrados) > 0 ) {
            foreach ($Deportistasenviados as $item) {
                if (!in_array($item, $Registrados)) {
                    array_push($Deportistasnuevos, $item);
                }

            }
        }


        if (sizeof($Registrados) < 1) {
            foreach ($Deportistasenviados as $item) {

                array_push($Deportistasnuevos, $item);
            }
        }



        $Deportistaseliminados = [];
        foreach ($Registrados as $item) {
            if (!in_array($item, $Deportistasenviados)) {
                array_push($Deportistaseliminados, $item);
            }
        }

        foreach ($Deportistaseliminados as $item) {
            $GruposDeportistasID = Grupos_Deportistas::select(['GruposDeportistasId'])
            ->where('GrupoId', '=', $request->IdGrupo)->where('Documento', '=', $item)->get();
            $GrupoDeportista = Grupos_Deportistas::find($GruposDeportistasID[0]['GruposDeportistasId']);
            $GrupoDeportista->delete();
        }


        foreach ($Deportistasnuevos as $item) {
            $GruposDeportistas = new Grupos_Deportistas();
            $GruposDeportistas->GruposDeportistasId = Grupos_Deportistas::creadorPK($GruposDeportistas, 1000);
            $GruposDeportistas->Documento = $item;
            $GruposDeportistas->FechaIngreso = date('Y-m-d');
            $GruposDeportistas->GrupoId = $request->IdGrupo;
            $GruposDeportistas->save();
        }
        return redirect('grupos/listar/2');
    }


    public function changeState(Request $request)
    {
        //   $GrupoId = $request->GrupoId;
        $GrupoId = json_decode($request->GrupoId);
        $Grupo = Grupo::find($GrupoId);

        if ($Grupo->Estado == true) {
            $Grupo->Estado = false;
        } else {
            $Grupo->Estado = true;
        }

        $Grupo->save();

        return json_encode($Grupo);
    }


    public function getDetalle(Request $request)
    {
        $GrupoId = $request->GrupoId;
        $DeportasRescatados = [];


        $Grupo = Grupo::select(['NombreGrupo','categorias.NombreCategoria','users.Nombre'])
        ->join('categorias', 'grupos.CategoriaId', '=', 'categorias.CategoriaId')
        ->join('users', 'grupos.Documento', '=', 'users.Documento')->where('GrupoId', '=', $GrupoId)
        ->get();



        $Deportista = Grupos_Deportistas::select(['deportistas.Nombre'])
            ->join('deportistas', 'grupos_deportistas.Documento', '=', 'deportistas.Documento')
            ->where('grupos_deportistas.GrupoId', '=', $GrupoId)
            ->get();

        array_push($DeportasRescatados, $Grupo, $Deportista);

        return $DeportasRescatados;
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
