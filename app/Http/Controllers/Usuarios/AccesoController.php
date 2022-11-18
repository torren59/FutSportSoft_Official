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

    public function restableceClave(){
        return view('Usuarios.passwordretrieve');
    }

    public function getRetrieveUrl($email){

        $Token = User::select(['remember_token'])
        ->where('email','=',$email)
        ->first();

        $Url = 'http://127.0.0.1:8000/acceso/newpassword/'.$email.'/'.$Token['remember_token'];

        return $Url;


    }

    public function enviamail(Request $request){

        // Validando email ingresado
        $validator = Validator::make($request->only('email'), 
        ['email' => 'required|email|exists:users'],
        ['required' => 'No envíe este campo vacío','email' => 'Solo puede ingresar un email en este campo', 
        'exists' => 'Esta dirección de correo electrónico no existe en nuestros registros']);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $Url = $this->getRetrieveUrl($request->email);
        $User = User::all()->where('email','=',$request->email);
        Mail::to($User)->send(new passwordRetrieve($User, $Url)); 

        

    }

    public function getNuevaClave($email, $Token){
        // Acá se redireccionará a la vista de cambio de contraseña
    }


    public function creaUsuario()
    {
        $user = new User();
        $user->Documento = '100022233';
        $user->Nombre = 'Usuario validable';
        $user->RolId = '1';
        $user->Celular = '3214321212';
        $user->email = 'email2@email.com';
        $user->Direccion = 'Calle B';
        $user->FechaNacimiento = '2022-12-11';
        $user->password = Hash::make('clave');
        $user->forceFill([])->setRememberToken(Str::random(60));
        $user->save();

        return 'Hola fifi';
    }

    
}
