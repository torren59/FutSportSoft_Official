<?php

namespace App\Http\Middleware;

use App\Models\Roles\Permiso_Rol;
use App\Models\Roles\Rol;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $RolId = $user->RolId;
        $row = Rol::select(['permisos.PermisoId','roles.RolId','permisos_roles.PermisoRolId'])
        ->join('permisos_roles','permisos_roles.RolId','=','roles.RolId')
        ->join('permisos','permisos.PermisoId','=','permisos_roles.PermisoId')
        ->where('permisos.PermisoId','=',$PermisoId)
        ->where('roles.RolId','=',$RolId)
        ->count();

        if($row < 1){
            return response('HTTP 405 Method Not Allowed', 405)
            ->header('Content-Type', 'text/plain');
        }

        return $next($request);
    }
}
