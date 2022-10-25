<?php
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InicialController;
use App\Http\Controllers\Programacion\DeportesController;
use App\Http\Controllers\Programacion\HorariosController;
use App\Http\Controllers\Programacion\ProgramacionesController;
use App\Http\Controllers\Programacion\SedesController;

use App\Http\Controllers\Ventas\VentasController;
use App\Http\Controllers\Compras\ProductosController;
use App\Http\Controllers\Compras\ProveedoresController;
use App\Http\Controllers\Programacion\DeportistasController;
use App\Http\Controllers\Ayudas\AyudasController;
use App\Http\Controllers\Configuracion\RolesController;
use App\Http\Controllers\Programacion\CategoriaController;
use App\Http\Controllers\Usuarios\UsuarioController;

use Illuminate\Http\Request;
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
        Route::get('roles/listar', 'index');
        Route::post('roles/crear', 'create');
        Route::get('roles/editar/{id}','edit');
        Route::post('roles/actualizar/{id}','update');

    }
);

Route::controller(UsuarioController::class)->group(
    function () {
        Route::get('usuario/listar', 'index');
        Route::post('usuario/crear', 'create');
        Route::get('usuario/editar/{id}','edit');
        Route::post('usuario/actualizar/{id}','update');

    }
);

Route::controller(CategoriaController::class)->group(
    function () {
        Route::get('categoria/listar', 'index');
        Route::post('categoria/crear', 'create');
        Route::get('categoria/editar/{id}','edit');
        Route::post('categoria/actualizar/{id}','update');

    }
);

Route::controller(DeportesController::class)->group(
    function () {
        Route::get('deporte/listar', 'index');
        Route::post('deporte/crear', 'create');
        Route::get('deporte/editar/{id}', 'edit');
        Route::post('deporte/actualizar/{id}','update');
        Route::get('select/getcategoria/{DeporteId?}','getcategorias');
        Route::get('select/getgrupo/{CategoriaId?}','getgrupos');
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
        Route::post('venta/crear', 'create');
        Route::post('venta/listaseleccionados','listselected');
        Route::get('venta/editar/{id}', 'edit');
        Route::post('venta/actualizar/{id}','update');
    }
);

Route::controller(ProveedoresController::class)->group(
    function () {
        Route::get('proveedor/listar', 'index');
        Route::post('proveedor/crear', 'create');
        Route::get('proveedor/editar/{id}', 'edit');
        Route::post('proveedor/actualizar/{id}','update');
    }
);

Route::controller(ProductosController::class)->group(
    function () {
        Route::get('producto/listar', 'index');
        Route::post('producto/crear', 'create');
        Route::get('producto/editar/{id}', 'edit');
        Route::post('producto/actualizar/{id}','update');
    }
);

Route::controller(DeportistasController::class)->group(
    function () {
        Route::get('deportista/listar', 'index');
        Route::post('deportista/crear', 'create');
        Route::get('deportista/editar/{id}', 'edit');
        Route::post('deportista/actualizar/{id}','update');
    }
);

Route::controller(AyudasController::class)->group(
    function () {
        Route::get('ayudas', 'listar');
    }
);
