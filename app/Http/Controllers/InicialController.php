<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InicialController extends Controller
{

    function  index(){        
        return view('inicial');
    }

    function login(){
        $Credenciales = request()->only('email','password');

        if(Auth::attempt($Credenciales)){
            $id = Auth::id();
            return 'Has ingresado '.$id;
        }
        else{
            return 'No has ingresado'.$Credenciales['email'].' '.$Credenciales['password'];
        }
    }

}
