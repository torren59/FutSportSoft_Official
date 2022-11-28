<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Grupos;
use App\Models\Programacion\Categoria;
use App\Models\Programacion\Deportista;
use App\Models\Programacion\Grupo;
use App\Models\Programacion\Grupos_Deportistas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ListadoGrupos = Grupos::select(['GrupoId','categorias.NombreCategoria','users.Nombre','NombreGrupo','grupos.Estado'])
        ->join('users','grupos.Documento','=','users.Documento')
        ->join('categorias','grupos.CategoriaId','=','categorias.CategoriaId')

        ->get();
        $ListadoCategoria = Categoria::all();
        $ListadoUsuario = User::all();
        $Listados = ['ListadoGrupos'=>$ListadoGrupos,'ListadoCtegoria'=>$ListadoCategoria,'ListadoUsuario'=>$ListadoUsuario];
         return view('Programacion.grupos')->with('listado', $Listados);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ProductModel = new Deportista();
        $Deportista = $ProductModel->all();
        return view('Programacion.grupos')->with('deportistas', $Deportista);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(),
        // ['NumeroFactura'=>'min:1|unique:compras,NumeroFactura|max:20','Nit'=>'min:1|max:12','FechaCompra'=>'min:1|max:20','ValorCompra'=>'min:1||max:20','SubTotal'=>'min:1||max:20','Iva'=>'min:1||max:20','Descuento'=>'min:1||max:20'],
        // ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);

        // if($validator->fails()){
        //     return back()->withErrors($validator)->withInput();
        // }
        $Grupo = new Grupo();
        $GrupoId= Grupo::creadorPK($Grupo,1000);
        $Grupo->GrupoId=$GrupoId;
        $Campos = ['GrupoId','CategoriaId','Documento','NombreGrupo','Estado'];
        foreach($Campos as $item){
            $Grupo->$item = $request->$item;

        }

        $Grupo->save();

        $Deportista = $request->deportistas;


        if($Deportista == null){
            return 'Evite enviar adicionar Deportistas vacío';
        }



        foreach($Deportista as $item){
            // Crea registros en la tabla de artículos comprados
            $articulo = new Grupos_Deportistas();
            $articulo->GruposDeportistasId = Grupos_Deportistas::creadorPK($articulo, 1000);
            $articulo->GrupoId = $GrupoId;
            $articulo->Documento = $item->Documento;
            $articulo->FechaIngreso = date('Y-m-d');
            $articulo->save();

        }

        return redirect('dashboard/panel');
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

    public function listselected(Request $request)
    {
        $DeportistaModel = new Deportista();
        $Selecteds = json_decode($request->seleccionados);
        $checkeds = $DeportistaModel->whereIn('Documento', $Selecteds)->select('Nombre','Documento')->get();
        return json_encode($checkeds);
    }
}
