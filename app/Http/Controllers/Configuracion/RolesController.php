<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Roles;
use App\Models\Roles\Permiso;
use App\Models\Roles\Permiso_Rol;
use App\Models\Roles\Rol;
use App\Rules\noRepeatRolName;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $ListadoRoles = Roles::all();
        $permisos = Permiso::select(['PermisoId', 'NombrePermiso'])->get();



        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('configuracion.Roles')->with('listado', $ListadoRoles)->with('permisos_crear', $permisos)->with('sweet_setAll', $sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title' => 'Registro editado', 'msg' => 'El registro se editó exitosamente', 'type' => 'success'];
                return view('configuracion.Roles')->with('listado', $ListadoRoles)->with('permisos_crear', $permisos)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
                return view('configuracion.Roles')->with('listado', $ListadoRoles)->with('permisos_crear', $permisos);
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['name' => 'min:1|max:50'],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $Roles = new Roles();
        $id = $Roles::creadorPK($Roles, 100);
        $Roles->id = $id;
        $Campos = ['name'];
        foreach ($Campos as $item) {
            $Roles->$item = $request->$item;
        }

        $Roles->save();

        $Permisos = $request->permisos;

        if ($Permisos == null) {
            return redirect('roles/listar');
        }
        foreach ($Permisos as $item) {

            // Llena el objeto con los datos de un producto adicionado
            $Adicionados = new Permiso_Rol();
            $Adicionados->PermisoId = $item;
            $Adicionados->PermisoRolId = Permiso_Rol::creadorPK($Adicionados, 100);
            $Adicionados->id = $id;

            $Adicionados->save();
        }

        return redirect('roles/listar');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Selected =  Roles::all()->where('id', '=', $id);

        $permisos_total = Permiso::all();

        $permisosdelrol = Rol::select(['permisos.PermisoId'])
            ->join('permisos_roles', 'permisos_roles.id', '=', 'roles.id')
            ->join('permisos', 'permisos_roles.PermisoId', '=', 'permisos.PermisoId')
            ->where('roles.id', '=', $id)
            ->get();


        // $total_permisos = [];
        // foreach($permisos_total as $item){
        //     array_push($total_permisos, $item->PermisoId);
        // }

        $permisos_seleccionados = [];
        foreach ($permisosdelrol as $item) {
            array_push($permisos_seleccionados, $item->PermisoId);
        }

        return view('configuracion.editarroles')->with('roldata', $Selected)->with('total_permisos', $permisos_total)->with('permisos_checked', $permisos_seleccionados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->IdRol;

        $validator = Validator::make(
            $request->all(),
            ['name' => ['min:1', new noRepeatRolName, 'max:50']],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $Roles = Roles::find($id);
        $Campos = ['name'];
        foreach ($Campos as $item) {
            $Roles->$item = $request->$item;
        }
        $Roles->save();


        $Permisosenviados = $request->chequeados;
        if($Permisosenviados == null){
            $Permisosenviados = [];
        }

        $Permisosdelrol = Rol::select(['permisos.PermisoId'])
            ->join('permisos_roles', 'permisos_roles.id', '=', 'roles.id')
            ->join('permisos', 'permisos_roles.PermisoId', '=', 'permisos.PermisoId')
            ->where('roles.id', '=', $id)
            ->get();


        $Registrados = [];
        if(sizeof($Permisosdelrol) > 0){
            foreach ($Permisosdelrol as $item) {
                array_push($Registrados, $item->PermisoId);
            }
        }




        $Permisosnuevos = [];
        if (sizeof($Permisosenviados) > 0 && sizeof($Registrados) > 0 ) {
            foreach ($Permisosenviados as $item) {
                if (!in_array($item, $Registrados)) {
                    array_push($Permisosnuevos, $item);
                }
            }
        }



        if (sizeof($Registrados) < 1) {
            foreach ($Permisosenviados as $item) {

                array_push($Permisosnuevos, $item);
            }
        }




        $Permisoseliminados = [];
        foreach ($Registrados as $item) {
            if (!in_array($item, $Permisosenviados)) {
                array_push($Permisoseliminados, $item);
            }
        }

        foreach ($Permisoseliminados as $item) {
            $PermisoRolId = Permiso_Rol::select(['PermisoRolId'])->where('id', '=', $request->IdRol)->where('PermisoId', '=', $item)->get();
            $Permisorol = Permiso_Rol::find($PermisoRolId[0]['PermisoRolId']);
            $Permisorol->delete();
        }

        foreach ($Permisosnuevos as $item) {
            $PermisoRol = new Permiso_Rol();
            $PermisoRol->PermisoRolId = Permiso_Rol::creadorPK($PermisoRol, 1000);
            $PermisoRol->PermisoId = $item;
            $PermisoRol->id = $request->IdRol;
            $PermisoRol->save();
        }
        return redirect('roles/listar/2');
    }
    public function getDetalle(Request $request)
    {
        $id = $request->id;
        $PermisosRescatados = [];


        $Roles = Rol::select(['name'])->where('id', '=', $id)
            ->get();



        $Permiso = Permiso_Rol::select(['permisos.NombrePermiso'])
            ->join('permisos', 'permisos_roles.PermisoId', '=', 'permisos.PermisoId')
            ->where('permisos_roles.id', '=', $id)
            ->get();

        array_push($PermisosRescatados, $Roles, $Permiso);

        return $PermisosRescatados;
    }

    public function changeState(Request $request)
    {
        $id = json_decode($request->id);
        $Rol = Rol::find($id);

        if ($Rol->Estado == true) {
            $Rol->Estado = false;
        } else {
            $Rol->Estado = true;
        }

        $Rol->save();

        return json_encode($Rol);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
