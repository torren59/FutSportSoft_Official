<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $User = Auth::user();
        $RolId = $User->RolId;
        $id = $User->id;
        $ListadoUsuario = [];

        if ($RolId == 1) {
            $ListadoUsuario = User::select(['users.id', 'Documento', 'Nombre', 'users.Estado', 'roles.name', 'Direccion', 'email', 'RolId', 'Celular','password'])
                ->join('roles', 'users.RolId', '=', 'roles.id')
                ->get();
        } else {
            $ListadoUsuario = User::select(['users.id', 'Documento', 'Nombre', 'users.Estado', 'roles.name', 'Direccion', 'email', 'RolId', 'Celular','password'])
                ->join('roles', 'users.RolId', '=', 'roles.id')
                ->where('users.id', '=', $id)
                ->get();
        }

        $ListadoRoles = Roles::all();
        $Listados = ['ListadoUsuario' => $ListadoUsuario, 'ListadoRoles' => $ListadoRoles];

        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('Usuarios.Usuario')->with('listado', $Listados)->with('sweet_setAll', $sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title' => 'Registro editado', 'msg' => 'El registro se editó exitosamente', 'type' => 'success'];
                return view('Usuarios.Usuario')->with('listado', $Listados)->with('sweet_setAll', $sweet_setAll);
                break;
                case 3:
                    $sweet_setAll = ['title' => 'Contraseña cambiada', 'msg' => 'La contraseña se cambio exitosamente', 'type' => 'success'];
                    return view('Usuarios.Usuario')->with('listado', $Listados)->with('sweet_setAll', $sweet_setAll);
                    break;
                default:
                    return view('Usuarios.Usuario')->with('listado', $Listados);
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
            ['Documento' => 'min:1|unique:users,Documento|max:10', 'Nombre' => 'min:1|max:50', 'RolId' => 'min:1|max:30|required', 'Direccion' => 'min:1|max:50', 'FechaNacimiento' => 'min:1|max:30', 'email' => 'min:1|unique:users,email|max:50', 'Celular' => 'min:1|max:11','password' => 'min:1|max:30'],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']

        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $Usuario = new User();
        $id = $Usuario::creadorPK($Usuario, 100);
        $Usuario->password = Hash::make($request->password);
        $Usuario->Documento = $id;
        $Usuario->forceFill([])->setRememberToken(Str::random(60));
        $Campos = ['Documento', 'Nombre', 'RolId', 'Direccion', 'Celular', 'email',  'FechaNacimiento','password'];
        foreach ($Campos as $item) {
            $Usuario->$item = $request->$item;
        }

        $Usuario->save();
        return redirect('usuario/listar/1');
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
        $Selected =  User::select('Nombre', 'roles.id as RolId', 'users.id', 'roles.name', 'Celular', 'email', 'Direccion', 'FechaNacimiento', 'users.Estado')
            ->join('roles', 'users.RolId', '=', 'roles.id')->where('users.id', '=', $id)
            ->get();
        $Roles = Roles::select(['roles.id', 'roles.name'])->get();
        $data = ['usuarios' => $Selected, 'roles' => $Roles];
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
        $validator = Validator::make(
            $request->all(),
            ['Nombre' => 'min:1|max:50', 'RolId' => 'min:1|max:50', 'Direccion' => 'min:1|max:70', 'Celular' => 'min:1|max:10','email' => 'min:1|max:50' , 'Direccion' => 'min:1|max:70', 'FechaNacimiento' => 'min:1|max:50', 'Celular' => 'min:1|max:11'],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $Usuario = User::find($id);
        $Campos = ['Nombre', 'RolId', 'Direccion', 'Celular', 'email', 'FechaNacimiento'];
        foreach ($Campos as $item) {
            $Usuario->$item = $request->$item;
        }
        $Usuario->save();
        return redirect('usuario/listar/2');
    }

    public function newPassword($id)
    {
        $User = User::find($id);
        $Operator = Auth::user();
        $RolId = $Operator->RolId;
        return view('Usuarios.cambiarclave')->with('User', $User)->with('RolId',$RolId);
    }

    public function changePassword(Request $request)
    {
        // Recibiendo ID y clave
        $UserId = $request->id;
        $NewPassword = $request->password;
        $User = User::find($UserId);
        $Operator = Auth::user();

        $RolId = $Operator->RolId;

        // Validando clave
        $validator = Validator::make(
            $request->all(),
            ['password' => 'required|max:15|same:confirmacion', 'confirmacion' => 'required'],
            ['required' => '* Evite enviar este campo vacío', 'max' => '* La clave no debe exceder un máximo de :max caracteres', 'same' => '* Clave no coincide con confirmacion']
        );
        if($RolId != 1){

            $User = User::find($UserId);
            if (!Hash::check($request->actual_password, $User->password)) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'actual_password',
                        'Esta no es tu clave actual'
                    );
                });
            }

        }


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        // Cambiando clave
        $User->forceFill([
            'password' => Hash::make($NewPassword)
        ]);
        $User->save();

        return redirect('usuario/listar/3');
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

    public function changeState(Request $request){
        $id = json_decode($request->id);
        $User = User::find($id);

        if($User->Estado == true){
            $User->Estado = false;
        }
        else{
            $User->Estado = true;
        }

        $User->save();

        return json_encode($User);

    }


    public function getDetalle(Request $request)
    {
        $id = $request->id;



        $Usuario = User::select(['users.id', 'Documento', 'Nombre', 'roles.name', 'Celular', 'email', 'Direccion', 'FechaNacimiento'])
            ->join('roles', 'users.RolId', '=', 'roles.id')
            ->where('users.id', '=', $id)
            ->get();



        return $Usuario;
    }
}
