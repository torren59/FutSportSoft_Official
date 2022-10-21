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
use App\Http\Controllers\Compras\ComprasController;
use App\Http\Controllers\Configuracion\RolesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Programacion\CategoriaController;
use App\Http\Controllers\Usuarios\AccesoController;
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
    return Redirect('login');
});

Route::controller(AccesoController::class)->group(
    function(){
        Route::get('login','index')->name('login');
        Route::post('acceso/validar','isValid');
        Route::post('acceso/salir','logOut');
        Route::get('marcha','creaUsuario');
    }
);

Route::controller(DashboardController::class)->middleware('auth')->group(
    function(){
        Route::get('dashboard/panel','index');
    }
);

Route::controller(RolesController::class)->middleware('auth')->group(
    function () {
        Route::get('roles/listar', 'index');
        Route::post('roles/crear', 'create');
        Route::get('roles/editar/{id}','edit');
        Route::post('roles/actualizar/{id}','update');
    }
);

Route::controller(ComprasController::class)->middleware('auth')->group(
    function () {
        Route::get('compras/listar', 'index');
        Route::get('compras/crear', 'create');
        Route::post('compras/store', 'store');
        Route::get('compras/editar/{id}','edit');
        Route::post('compras/actualizar/{id}','update');
    }
);

Route::controller(UsuarioController::class)->middleware('auth')->group(
    function () {
        Route::get('usuario/listar', 'index');
        Route::post('usuario/crear', 'create');
        Route::get('usuario/editar/{id}','edit');
        Route::post('usuario/actualizar/{id}','update');
    }
);

Route::controller(CategoriaController::class)->middleware('auth')->group(
    function () {
        Route::get('categoria/listar', 'index');
        Route::post('categoria/crear', 'create');
        Route::get('categoria/editar/{id}','edit');
        Route::post('categoria/actualizar/{id}','update');
    }
);

Route::controller(DeportesController::class)->middleware('auth')->group(
    function () {
        Route::get('deporte/listar', 'index');
        Route::post('deporte/crear', 'create');
        Route::get('deporte/editar/{id}', 'edit');
        Route::post('deporte/actualizar/{id}','update');
        Route::get('select/getcategoria/{DeporteId?}','getcategorias');
        Route::get('select/getgrupo/{CategoriaId?}','getgrupos');
    }
);

Route::controller(SedesController::class)->middleware('auth')->group(
    function () {
        Route::get('sede/listar', 'index');
        Route::post('sede/crear', 'create');
        Route::get('sede/editar/{id}','edit');
        Route::post('sede/actualizar/{id}','update');
    }
);

Route::controller(HorariosController::class)->middleware('auth')->group(
    function () {
        Route::get('horario/listar', 'index');
        Route::post('horario/crear', 'create');
        Route::get('horario/editar/{id}', 'edit');
        Route::post('horario/actualizar/{id}', 'update');
    }
);

Route::controller(ProgramacionesController::class)->middleware('auth')->group(
    function () {
        Route::get('programacion/listar', 'index');
        Route::post('programacion/crear', 'create');
    }
);

Route::controller(VentasController::class)->middleware('auth')->group(
    function(){
        Route::get('venta/listar', 'index');
        Route::get('venta/crear', 'create');
        Route::post('venta/listaseleccionados','listselected');
    }
);

Route::controller(ProveedoresController::class)->middleware('auth')->group(
    function () {
        Route::get('proveedor/listar', 'index');
        Route::post('proveedor/crear', 'create');
    }
);

Route::controller(ProductosController::class)->middleware('auth')->group(
    function () {
        Route::get('producto/listar', 'index');
        Route::post('producto/crear', 'create');
    }
);

Route::controller(DeportistasController::class)->middleware('auth')->group(
    function () {
        Route::get('deportista/listar', 'index');
        Route::post('deportista/crear', 'create');
    }
);

Route::controller(AyudasController::class)->middleware('auth')->group(
    function () {
        Route::get('ayudas', 'listar');
    }
);
