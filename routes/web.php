<?php

use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InicialController;
use App\Http\Controllers\Programacion\DeportesController;
use App\Http\Controllers\Programacion\HorariosController;
use App\Http\Controllers\Programacion\ProgramacionesController;
use App\Http\Controllers\Programacion\SedesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\Ventas\VentasController;
use App\Http\Controllers\Compras\ProductosController;
use App\Http\Controllers\Compras\ProveedoresController;
use App\Http\Controllers\Programacion\DeportistasController;
use App\Http\Controllers\Ayudas\AyudasController;
use Illuminate\Support\Facades\Redirect;
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
    return Redirect('home');
});

Route::controller(InicialController::class)->group(
    function () {
        Route::get('inicio', 'index')->name('LoginForm');
        Route::post('aut', 'login')->name('login');
    }
);


Route::get('home', function () {
    return view('layouts.home');
});


Route::controller(RolesController::class)->group(
    function () {
        Route::get('roles', 'listar');
    }
);

Route::controller(DeportesController::class)->group(
    function () {
        Route::get('deporte/listar', 'index');
        Route::post('deporte/crear', 'create');
        Route::get('deporte/editar/{id}', 'edit');
        Route::post('deporte/actualizar/{id}','update');
    }
);

Route::controller(SedesController::class)->group(
    function () {
        Route::get('sede/listar', 'index');
        Route::post('sede/crear', 'create');
        Route::get('sede/editar/{id}','edit');
        Route::post('sede/actualizar/{id}','update');
    }
);

Route::controller(HorariosController::class)->group(
    function () {
        Route::get('horario/listar', 'index');
        Route::post('horario/crear', 'create');
        Route::get('horario/editar/{id}', 'edit');
        Route::post('horario/actualizar/{id}', 'update');
    }
);

Route::controller(ProgramacionesController::class)->group(
    function () {
        Route::get('programacion/listar', 'index');
        Route::post('programacion/crear', 'create');
    }
);

Route::controller(VentasController::class)->group(
    function(){
        Route::get('venta/listar', 'index');
        Route::get('venta/crear', 'create');
        Route::post('venta/listaseleccionados','listselected');
    }
);

Route::controller(ProveedoresController::class)->group(
    function () {
        Route::get('proveedor/listar', 'index');
        Route::post('proveedor/crear', 'create');
    }
);

Route::controller(ProductosController::class)->group(
    function () {
        Route::get('producto/listar', 'index');
        Route::post('producto/crear', 'create');
    }
);

Route::controller(DeportistasController::class)->group(
    function () {
        Route::get('deportista/listar', 'index');
        Route::post('deportista/crear', 'create');
    }
);

Route::controller(AyudasController::class)->group(
    function () {
        Route::get('ayudas', 'listar');
    }
);
