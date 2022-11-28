<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $ListadoUsuario = User::select(['users.id','Documento','Nombre','users.Estado','roles.name'])
        ->join('roles','users.RolId','=','roles.id')
        ->get();
        $ListadoRoles = Roles::all();
        $Listados = ['ListadoUsuario'=>$ListadoUsuario,'ListadoRoles'=>$ListadoRoles];
        return view('Usuarios.Usuario')->with('listado', $Listados);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $validator = Validator::make(
        //     $request->all(),
        //      ['Documento' => 'min:1|unique:users,Documento|max:11','Nombre' => 'min:1|max:30', 'IdRol' => 'min:1|max:5|required', 'Direccion' => 'min:1|Direccion|max:100', 'FechaNacimiento' => 'min:1|max:30', 'password' => 'min:1|max:30'],
        //      ['unique' => 'Este campo no acepta información que ya se ha registrado', 'min' => 'No puedes enviar este campo vacío', 'max' => 'Máximo de :max dígitos']

        // );

        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        $Usuario = new User();
        $id = $Usuario::creadorPK($Usuario, 100);
        $Usuario->password = Hash::make($request->password);
        $Usuario->Documento = $id;
        $Campos = ['Documento', 'Nombre', 'RolId', 'Direccion', 'Celular', 'email',  'FechaNacimiento'];
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
        $Selected =  User::select('Nombre','roles.id as RolId','users.id','roles.name','Celular','email','Direccion','FechaNacimiento')
        ->join('roles','users.RolId','=','roles.id')->where('users.id', '=', $id)
        ->get();
        $Roles = Roles::select(['roles.id','roles.name'])->get();
        $data = ['usuarios'=>$Selected,'roles'=>$Roles];
        return view('Usuarios.editarusuario')->with('data', $data);





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
        //  $validator = Validator::make($request->all(),
        //   ['Nombre'=>'min:1|max:30','RolId'=>'min:1|max:50','Direccion'=>'min:1|max:70','Celular'=>'min:1|max:10','email'=>'min:1|max:70','Direccion'=>'min:1|max:70','FechaNacimiento'=>'min:1|max:50','password'=>'min:1|max:30'],
        //  ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);

        //  if($validator->fails()){
        //       return back()->withErrors($validator)->withInput();
        //  }
        $Usuario = User::find($id);
        $Campos = ['Nombre', 'RolId', 'Direccion', 'Celular', 'email', 'FechaNacimiento', 'password'];
        foreach($Campos as $item){
            $Usuario->$item = $request->$item;
        }
        $Usuario->save();
        return redirect('usuario/listar');
    }

    public function newPassword($id){
        $User = User::find($id);
        return view('Usuarios.cambiarclave')->with('User',$User);
    }

    public function changePassword(Request $request){
        // Recibiendo ID y clave
        $UserId = $request->id;
        $NewPassword = $request->password;

        // Validando clave
        $validator = Validator::make($request->all(),
    ['password' => 'required|max:15|same:confirmacion','confirmacion'=>'required','actual_password'=>'required'],
    ['required'=>'Evite enviar este campo vacío','max'=>'La clave no debe exceder un máximo de :max caracteres','same'=>'Clave no coincide con confirmacion']);

    $User = User::find($UserId);
    if(!Hash::check($request->actual_password, $User->password)){
        $validator->after(function($validator){
            $validator->errors()->add(
                'actual_password', 'Esta no es tu clave actual'
            );
        });
    }

    
    if($validator->fails()){
        return back()->withErrors($validator)->withInput();
    }


    // Cambiando clave
    $User->forceFill([
        'password' => Hash::make($NewPassword)
    ]);
    $User->save();

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

    public function getDetalle(Request $request){
        $id = $request->id;



        $Usuario = User::select(['users.id','Documento','Nombre','roles.name','Celular','email','Direccion','FechaNacimiento'])
        ->join('roles','users.RolId','=','roles.id')
        ->where('users.id','=',$id)
        ->get();



        return $Usuario;

    }


}
