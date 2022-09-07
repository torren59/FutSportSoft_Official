<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    function listar(){
        $proveedores = DB::select('select NombreEmpresa from proveedores');
        return view('configuracion.roles', ['proveedores' => $proveedores]);
    }
}
