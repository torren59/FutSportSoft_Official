<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Roles;
use App\Models\Roles\Permiso;
use App\Models\Roles\Rol;
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
    public function index()
    {
        $ListadoRoles = Roles::all();
        $permisos = Permiso::select(['PermisoId','NombrePermiso'])->get();
        return view('configuracion.Roles')->with('listado', $ListadoRoles)->with('permisos_crear',$permisos);
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
            ['name' => 'min:1|unique:roles,name|max:50'],
            ['unique' => 'Este campo no acepta información que ya se ha registrado', 'min' => 'No puedes enviar este campo vacío', 'max' => 'Máximo de :max dígitos']
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

        $permisosdelrol = Rol::select(['permisos.PermisoId'])
        ->join('permisos_roles','permisos_roles.id','=','roles.id')
        ->join('permisos','permisos_roles.PermisoId','=','permisos.PermisoId')
        ->where('roles.id','=',$id)
        ->get();

        $permisos_seleccionados = [];
        foreach($permisosdelrol as $item){
            array_push($permisos_seleccionados, $item->PermisoId);
        }

        return view('configuracion.editarroles')->with('roldata', $Selected);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        ['name'=>'min:1|max:50'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }
        $Roles = Roles::find($id);
        $Campos = ['name'];
        foreach($Campos as $item){
            $Roles->$item = $request->$item;
        }
        $Roles->save();
        return redirect('roles/listar');
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
