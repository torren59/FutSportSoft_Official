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
    public function index()
    {

        $ListadoCategoria = Categoria::select(['CategoriaId','NombreCategoria','deportes.NombreDeporte','RangoEdad',])
        ->join('deportes','categorias.DeporteId','=','deportes.DeporteId')
        ->get();
        $ListadoDeporte = Deporte::all();
        $Listados = ['ListadoCategoria'=>$ListadoCategoria,'ListadoDeporte'=>$ListadoDeporte];
         return view('Programacion.Categoria')->with('listado', $Listados);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $validator = Validator::make($request->all(),
        // $request->all(),
        //      ['NombreCategoria' => 'min:1|unique:categorias,NombreCategoria|max:50','DeporteId' => 'min:1|max:5|required', 'RangoEdad' => 'min:1|unique:categorias,RangoEdad|max:100'],
        //      ['unique' => 'Este campo no acepta información que ya se ha registrado', 'min' => 'No puedes enviar este campo vacío', 'max' => 'Máximo de :max dígitos']);

        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        $Categoria = new Categoria();
        $id = $Categoria::creadorPK($Categoria, 100);
        $Categoria->CategoriaId = $id;
        $Campos = ['NombreCategoria', 'DeporteId', 'RangoEdad'];
        foreach ($Campos as $item) {
            $Categoria->$item = $request->$item;
        }

        $Categoria->save();
        return redirect('categoria/listar');
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
        $Selected =  Categoria::select(['CategoriaId','deportes.DeporteId','deportes.NombreDeporte','NombreCategoria','RangoEdad'])
        ->join('deportes','categorias.DeporteId','=','deportes.DeporteId')->where('CategoriaId', '=', $id)
        ->get();
        $Deporte = Deporte::select(['DeporteId','NombreDeporte'])->get();
        $data = ['categorias'=>$Selected,'deportes'=>$Deporte];
        return view('Programacion.editarcategoria')->with('data', $data);
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
        // $validator = Validator::make($request->all(),
        //  ['Nombre'=>'min:1|max:30','RolId'=>'min:1|max:50','Direccion'=>'min:1|max:70','Celular'=>'min:1|max:10','email'=>'min:1|max:70','Direccion'=>'min:1|max:70','FechaNacimiento'=>'min:1|max:50','password'=>'min:1|max:30'],
        //  ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);

        //  if($validator->fails()){
        //      return back()->withErrors($validator)->withInput();
        // }
        $Categoria = Categoria::find($id);
        $Campos = ['DeporteId','NombreCategoria','RangoEdad'];
        foreach($Campos as $item){
            $Categoria->$item = $request->$item;
        }
        $Categoria->save();
        return redirect('categoria/listar');
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
