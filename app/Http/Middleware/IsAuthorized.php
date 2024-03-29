<?php

namespace App\Http\Middleware;

use App\Models\Roles\Permiso_Rol;
use App\Models\Roles\Rol;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class IsAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $PermisoId)
    {
        $user = Auth::user();
        $id = $user->RolId;
        $row = Rol::select(['permisos.PermisoId','roles.id','permisos_roles.PermisoRolId'])
        ->join('permisos_roles','permisos_roles.id','=','roles.id')
        ->join('permisos','permisos.PermisoId','=','permisos_roles.PermisoId')
        ->where('permisos.PermisoId','=',$PermisoId)
        ->where('roles.id','=',$id)
        ->count();

        if($row < 1){
            return response('HTTP 405 Method Not Allowed', 405)
            ->header('Content-Type', 'text/plain');
        }

        $permisos = Rol::select(['permisos.PermisoId'])
        ->join('permisos_roles','permisos_roles.id','=','roles.id')
        ->join('permisos','permisos.PermisoId','=','permisos_roles.PermisoId')
        ->where('roles.id','=',$id)
        ->get();

        $permisos_plain = [];
        
        foreach($permisos as $item){
            array_push($permisos_plain, $item->PermisoId);
        }

        View::share('permisos',$permisos_plain);

        return $next($request);
    }
}
