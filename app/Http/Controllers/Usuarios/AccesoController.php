<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Mail\passwordRetrieve;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AccesoController extends Controller
{
    public function index()
    {
        return view('Usuarios.login');
    }

    public function isValid(Request $request)
    {

        $credentials = request()->only('email', 'password');

        $validator = Validator::make(
            $credentials,
            ['email' => 'required|email', 'password' => 'required'],
            ['required' => 'Campo obligatorio', 'email' => 'Necesario ingresar un email']
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('dashboard/panel');
        }

        return back()
            ->withErrors(['unautorizedAccess' => 'Correo o contraseña no concuerdan'])
            ->onlyInput('email');
    }


    public function logOut(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function retrievePassword(){
        return view('Usuarios.passwordretrieve');
    }

    public function getRetrieveUrl($email){

        $Token = User::select(['remember_token'])
        ->where('email','=',$email)
        ->first();

        $Url = 'http://127.0.0.1:8000/acceso/nuevaclave/'.$email.'/'.$Token['remember_token'];

        return $Url;


    }

    public function SendMail(Request $request){

        // Validando email ingresado
        $validator = Validator::make($request->all(), 
        ['email' => 'required|email|exists:users'],
        ['required' => 'No envíe este campo vacío','email' => 'Solo puede ingresar un email en este campo', 
        'exists' => 'Esta dirección de correo electrónico no existe en nuestros registros']);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        // Enviando email
        $Url = $this->getRetrieveUrl($request->email);
        $User = User::all()->where('email','=',$request->email);
        Mail::to($User)->send(new passwordRetrieve($User, $Url)); 

        return view('Usuarios.passwordConfirmation')->with('email', $User->email);

    }

    public function getNewPasswordForm($email, $Token){
        $Info = ['email'=>$email, 'Token'=>$Token];
        $User = User::where('email','=',$email);

        if($User->remember_token != $Token){
            return redirect('/login');
        }

        return view('Usuarios.newPasswordForm')->with('Info',$Info);
    }



    public function setNewPassword(Request $request){

        $validator = Validator::make($request->all(),
        ['nuevaclave'=>'required','confirmacion' => 'required|same:nuevaclave'],
        ['required' => 'Evita enviar alguno de los campos vacío','same'=>'Contraseñas no coinciden']);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $User = User::where('email','=',$request->email);

        if($User->remember_token != $request->token){
            return redirect('/login');
        }

        $User->forceFill([
            'password' => Hash::make($request->confirmacion)
        ])->setRememberToken(Str::random(60));

        $User->save();
        
        $sweet_setAll = ['title'=>'Cambio realizado', 'msg'=>'Ya puedes ingresar con tu nueva clave', 'type'=>'success'];
        return view('Usuarios.login')->with('sweet_setAll',$sweet_setAll);
    }


    public function creaUsuario()
    {
        /*$user = new User();
        $user->Documento = '100022233';
        $user->Nombre = 'Usuario validable';
        $user->RolId = '1';
        $user->Celular = '3214321212';
        $user->email = 'email2@email.com';
        $user->Direccion = 'Calle B';
        $user->FechaNacimiento = '2022-12-11';
        $user->password = Hash::make('clave');
        $user->forceFill([])->setRememberToken(Str::random(60));
        $user->save();*/

        $user = new User();
        $user->Documento = '1007657233';
        $user->Nombre = 'David Torres';
        $user->RolId = '1';
        $user->Celular = '3214321212';
        $user->email = 'david.torres59@soy.sena.edu.co';
        $user->Direccion = 'Calle B';
        $user->FechaNacimiento = '2022-12-10';
        $user->password = Hash::make('clave');
        $user->forceFill([])->setRememberToken(Str::random(60));
        $user->save();

        return 'Hola fifi';
    }

    
}
