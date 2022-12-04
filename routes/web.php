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
use App\Http\Controllers\Programacion\GruposController;
use App\Http\Controllers\Usuarios\AccesoController;
use App\Http\Controllers\Usuarios\UsuarioController;
use App\Models\Roles\Permiso_Rol;
use App\Models\Roles\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return view('Usuarios.login');
    // return view('Usuarios.newPasswordForm');
});

Route::controller(AccesoController::class)->group(
    function(){
        Route::get('login/{status?}','index')->name('login');
        Route::post('acceso/validar','isValid');
        Route::post('acceso/salir','logOut');
        Route::get('marcha','creaUsuario');
        Route::get('acceso/restablececlave', 'retrievePassword');
        Route::post('acceso/enviamail', 'SendMail');
        Route::get('acceso/nuevaclave/{email}/{token}','getNewPasswordForm');
        Route::post('acceso/setnuevaclave','setNewPassword');
    }
);

Route::controller(DashboardController::class)->middleware('auth')->group(
    function(){
        Route::match(['get' ,'post'], 'dashboard/panel', 'index')->middleware('IsAuthorized:113');
        Route::post('dashboard/getInitialIntervals','useFirstInterval');
        Route::post('dashboard/getNewIntervals','useNewInterval');
    }
);

Route::controller(RolesController::class)->middleware('auth')->group(
    function () {
        Route::get('roles/listar', 'index')->middleware('IsAuthorized:100');
        Route::post('roles/crear', 'create')->middleware('IsAuthorized:119');
        Route::get('roles/editar/{id}','edit')->middleware('IsAuthorized:132');
        Route::get('roles/getDetalle/{id?}','getDetalle')->middleware('IsAuthorized:114');
        Route::post('roles/actualizar/{id}','update');
    }
);

Route::controller(ComprasController::class)->middleware('auth')->group(
    function () {
        Route::get('compras/listar', 'index')->middleware('IsAuthorized:102');
        Route::any('compras/crearproveedor', 'create')->middleware('IsAuthorized:121');
        Route::get('compras/create', 'createview')->middleware('IsAuthorized:121');
        Route::post('compras/store', 'store');
        Route::get('compras/editar/{id}','edit');
        Route::get('compras/getDetalle/{NumeroFactura?}','getDetalle')->middleware('IsAuthorized:116');
        Route::post('/compras/listaseleccionados','listselected');


    }
);

Route::controller(GruposController::class)->middleware('auth')->group(
    function () {
        Route::get('grupos/listar', 'index')->middleware('IsAuthorized:109');
        Route::post('grupos/store', 'store')->middleware('IsAuthorized:128');
        Route::get('grupos/editar/{GrupoId}','edit')->middleware('IsAuthorized:140');
        Route::get('grupos/getDetalle/{GruposId?}','getDetalle')->middleware('IsAuthorized:117');
        Route::post('/grupos/listaseleccionados','listselected');


    }
);

Route::controller(UsuarioController::class)->middleware('auth')->group(
    function () {
        Route::get('usuario/listar', 'index')->middleware('IsAuthorized:101');
        Route::post('usuario/crear', 'create')->middleware('IsAuthorized:120');
        Route::get('usuario/editar/{id}','edit')->middleware('IsAuthorized:133');
        Route::get('usuario/getDetalle/{id?}','getDetalle')->middleware('IsAuthorized:115');
        Route::post('usuario/actualizar/{id}','update');
        Route::get('usuario/newpassword/{id}','newPassword')->middleware('IsAuthorized:142');
        Route::post('usuario/changepassword','changePassword');
    }
);

Route::controller(CategoriaController::class)->middleware('auth')->group(
    function () {
        Route::get('categoria/listar', 'index')->middleware('IsAuthorized:108');
        Route::post('categoria/crear', 'create')->middleware('IsAuthorized:127');
        Route::get('categoria/editar/{id}','edit')->middleware('IsAuthorized:139');
        Route::post('categoria/actualizar/{id}','update');
    }
);

Route::controller(DeportesController::class)->middleware('auth')->group(
    function () {
        Route::get('deporte/listar', 'index')->middleware('IsAuthorized:110');
        Route::post('deporte/crear', 'create')->middleware('IsAuthorized:130');
        Route::get('deporte/editar/{id}', 'edit')->middleware('IsAuthorized:141');
        Route::post('deporte/actualizar/{id}','update');
        Route::get('select/getcategoria/{DeporteId?}','getcategorias');
        Route::get('select/getgrupo/{CategoriaId?}','getgrupos');
        Route::post('deporte/cambiarEstado','changeState');
        Route::post('deporte/puedeCambiar','canChange');
    }
);

Route::controller(SedesController::class)->middleware('auth')->group(
    function () {
        Route::get('sede/listar/{status?}', 'index')->middleware('IsAuthorized:106');
        Route::post('sede/crear', 'create')->middleware('IsAuthorized:125');
        Route::get('sede/editar/{id}','edit')->middleware('IsAuthorized:137');
        Route::post('sede/actualizar/{id}','update');
        Route::post('sede/cambiarEstado','changeState');
        Route::post('sede/puedeCambiar','canChange');
    }
);

Route::controller(HorariosController::class)->middleware('auth')->group(
    function () {
        Route::get('horario/listar', 'index')->middleware('IsAuthorized:105');
        Route::post('horario/crear', 'create')->middleware('IsAuthorized:124');
        Route::get('horario/editar/{id}', 'edit')->middleware('IsAuthorized:136');
        Route::post('horario/actualizar/{id}', 'update');
        Route::post('horario/cambiarEstado','changeState');
        Route::post('horario/puedeCambiar','canChange');
    }
);

Route::controller(ProgramacionesController::class)->middleware('auth')->group(
    function () {
        Route::get('programacion/listar', 'index')->middleware('IsAuthorized:111');
        Route::post('programacion/crear', 'create')->middleware('IsAuthorized:129');
        Route::post('programacion/cambiarEstado','changeState');
    }
);

Route::controller(VentasController::class)->middleware('auth')->group(
    function(){
        Route::get('venta/listar', 'index')->middleware('IsAuthorized:112');
        Route::get('venta/crear', 'create')->middleware('IsAuthorized:131');
        Route::post('venta/store', 'store');
        Route::get('venta/getDetalle/{id?}','getDetalle')->middleware('IsAuthorized:118');
        Route::post('venta/listaseleccionados','listselected');
        Route::post('venta/addProducto','addProducto');
        Route::post('venta/deleteProducto','deleteProducto');
        Route::post('venta/getFacturacion','getFacturacion');
        Route::get('venta/Elim','elim');
        Route::get('venta/bbbccc','letSes');
    }
);

Route::controller(ProveedoresController::class)->middleware('auth')->group(
    function () {
        Route::get('proveedor/listar', 'index')->middleware('IsAuthorized:103');
        Route::post('proveedor/crear', 'create')->middleware('IsAuthorized:122');
        Route::get('proveedor/editar/{id}', 'edit')->middleware('IsAuthorized:134');
        Route::post('proveedor/actualizar/{id}','update');
    }
);

Route::controller(ProductosController::class)->middleware('auth')->group(
    function () {
        Route::get('producto/listar', 'index')->middleware('IsAuthorized:104');
        Route::post('producto/crear', 'create')->middleware('IsAuthorized:123');
        Route::get('producto/editar/{id}', 'edit')->middleware('IsAuthorized:135');
        Route::post('producto/actualizar/{id}','update');
    }
);

Route::controller(DeportistasController::class)->middleware('auth')->group(
    function () {
        Route::get('deportista/listar', 'index')->middleware('IsAuthorized:107');
        Route::post('deportista/crear', 'create')->middleware('IsAuthorized:126');
        Route::get('deportista/editar/{id}', 'edit')->middleware('IsAuthorized:138');
        Route::post('deportista/actualizar/{id}','update');
    }
);

Route::controller(AyudasController::class)->middleware('auth')->group(
    function () {
        Route::get('ayudas/listar', 'index');
    }
);

