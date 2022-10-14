<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ListadoUsuario = Usuario::all();
        return view('Usuarios.Usuario')->with('listado', $ListadoUsuario);
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
            ['Documento' => 'min:1|unique:usuario,Nombre|max:50', 'RolId' => 'min:1|max:30', 'Direccion' => 'min:1|unique:sedes,Direccion|max:100', 'FechaNacimiento' => 'min:1|max:30', 'Clave' => 'min:1|max:30'],
            ['unique' => 'Este campo no acepta información que ya se ha registrado', 'min' => 'No puedes enviar este campo vacío', 'max' => 'Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $Usuario = new Usuario();
        $id = $Usuario::creadorPK($Usuario, 100);
        $Usuario->Documento = $id;
        $Campos = ['Documento', 'Nombre', 'RolId', 'Direccion', 'Celular', 'Correo', 'Direccion', 'FechaNacimiento', 'Clave'];
        foreach ($Campos as $item) {
            $Usuario->$item = $request->$item;
        }

        $Usuario->save();
        return redirect('usuario/listar');
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
        $Selected =  Usuario::all()->where('Documento', '=', $id);
        return view('Programacion.editarusuario')->with('usuariodata', $Selected);
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
        ['Nombre'=>'min:1|max:50','RolId'=>'min:1|max:50','Direccion'=>'min:1|max:70','Celular'=>'min:1|max:50','Correo'=>'min:1|max:70','Direccion'=>'min:1|max:70','FechaNacimiento'=>'min:1|max:50','Clave'=>'min:1|max:30'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }
        $Usuario = Usuario::find($id);
        $Campos = ['Documento', 'Nombre', 'RolId', 'Direccion', 'Celular', 'Correo', 'Direccion', 'FechaNacimiento', 'Clave'];
        foreach($Campos as $item){
            $Usuario->$item = $request->$item;
        }
        $Usuario->save();
        return redirect('usuario/listar');
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
