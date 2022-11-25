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
        Route::get('dashboard/panel','index')->middleware('IsAuthorized:20');
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
        Route::get('compras/getDetalle/{NumeroFactura?}','getDetalle');
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
        Route::get('sede/listar/{status?}', 'index')->middleware('IsAuthorized:10');
        Route::post('sede/crear', 'create');
        Route::get('sede/editar/{id}','edit');
        Route::post('sede/actualizar/{id}','update');
        Route::post('sede/cambiarEstado','changeState');
        Route::post('sede/puedeCambiar','canChange');
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
        Route::post('programacion/cambiarEstado','changeState');
    }
);

Route::controller(VentasController::class)->middleware('auth')->group(
    function(){
        Route::get('venta/listar', 'index');
        Route::get('venta/crear', 'create');
        Route::post('venta/store', 'store');
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
        Route::get('proveedor/listar', 'index');
        Route::post('proveedor/crear', 'create');
        Route::get('proveedor/editar/{id}', 'edit');
        Route::post('proveedor/actualizar/{id}','update');
    }
);

Route::controller(ProductosController::class)->middleware('auth')->group(
    function () {
        Route::get('producto/listar', 'index');
        Route::post('producto/crear', 'create');
        Route::get('producto/editar/{id}', 'edit');
        Route::post('producto/actualizar/{id}','update');
    }
);

Route::controller(DeportistasController::class)->middleware('auth')->group(
    function () {
        Route::get('deportista/listar', 'index');
        Route::post('deportista/crear', 'create');
        Route::get('deportista/editar/{id}', 'edit');
        Route::post('deportista/actualizar/{id}','update');
    }
);

Route::controller(AyudasController::class)->middleware('auth')->group(
    function () {
        Route::get('ayudas/listar', 'index');
    }
);

Route::get('a/jaja', function(){
    $user = Auth::user();
    $RolId = $user->RolId;
    $permisos = Rol::select(['permisos.PermisoId'])
    ->join('permisos_roles','permisos_roles.RolId','=','roles.RolId')
    ->join('permisos','permisos.PermisoId','=','permisos_roles.PermisoId')
    ->where('roles.RolId','=',$RolId)
    ->get();

    $permisos_plain = [];
        
    foreach($permisos as $item){
        array_push($permisos_plain, intval($item->PermisoId));
    }

    return $permisos_plain;
});
