<?php

use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InicialController;
use App\Http\Controllers\Programacion\DeportesController;
use App\Http\Controllers\Programacion\HorariosController;
use App\Http\Controllers\Programacion\SedesController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use Whoops\RunInterface;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(InicialController::class)->group(
function(){
    Route::get('inicio','index')->name('LoginForm');
    Route::post('aut','login')->name('login');
}
);


Route::get('home',function(){
return view('layouts.home');
});


 Route::controller(RolesController::class)->group(
    function(){
    Route::get('roles','listar');
    }
 );

 Route::controller(DeportesController::class)->group(
    function(){
        Route::get('deporte/listar', 'index');
        Route::post('deporte/crear', 'create');
    }
 );

 Route::controller(SedesController::class)->group(
function(){
    Route::get('sede/listar', 'index');
    Route::post('sede/crear', 'create');
}
 );

 Route::controller(HorariosController::class)->group(
    function(){
        Route::get('horario/listar','index');
        Route::post('horario/crear','create');
    }
 );


