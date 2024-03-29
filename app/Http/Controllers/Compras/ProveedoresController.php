<?php

namespace App\Http\Controllers\Compras;

use App\Models\Compras\Proveedor;
use App\Http\Controllers\Controller;
use App\Rules\noRepeatAttribute;
use App\Rules\noRepeatRolName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $Proveedor = new Proveedor();
        $ListadoProveedor = $Proveedor->all();


        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('Compras.proveedores')->with('listado', $ListadoProveedor)->with('sweet_setAll', $sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title' => 'Registro editado', 'msg' => 'El registro se editó exitosamente', 'type' => 'success'];
                return view('Compras.proveedores')->with('listado', $ListadoProveedor)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
            return view('Compras.proveedores')->with('listado', $ListadoProveedor);
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
            ['Nit' => 'min:1|unique:proveedores,Nit|max:11', 'NombreEmpresa' => 'min:1|unique:proveedores,NombreEmpresa|max:50', 'Titular' => 'min:1|max:50', 'NumeroContacto' => 'min:1|max:15', 'Correo' => 'min:1|unique:proveedores,Correo|max:50', 'Direccion' => 'min:1|unique:proveedores,Direccion|max:50'],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $Proveedor = new Proveedor();
        $Campos = ['Nit', 'NombreEmpresa', 'Titular', 'NumeroContacto', 'Correo', 'Direccion'];
        foreach ($Campos as $item) {
            $Proveedor->$item = $request->$item;
        }

        $Proveedor->save();
        return redirect('proveedor/listar/1');
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

    public function changeState(Request $request)
    {
        $Nit = json_decode($request->Nit);
        $Proveedor = Proveedor::find($Nit);

        if ($Proveedor->Estado == true) {
            $Proveedor->Estado = false;
        } else {
            $Proveedor->Estado = true;
        }

        $Proveedor->save();

        return json_encode($Proveedor);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Selected =  Proveedor::all()->where('Nit', '=', $id);
        return view('Compras.editarproveedores')->with('proveedordata', $Selected);
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
        $request['Nit'] = $id;

        $validator = Validator::make(
            $request->all(),
            ['NombreEmpresa' => [
                'min:1', new noRepeatAttribute, 'max:50'
            ], 'Titular' => 'min:1|max:50', 'NumeroContacto' => 'min:1|max:15', 'Correo' => [
                'min:1', new noRepeatAttribute, 'max:50'
            ], 'Direccion' => [
                'min:1', new noRepeatAttribute, 'max:50'
            ]],
            ['unique' => '* Este campo no acepta información que ya se ha registrado', 'min' => '* No puedes enviar este campo vacío', 'max' => '* Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $Proveedor = Proveedor::find($id);
        $Campos = ['NombreEmpresa', 'Titular', 'NumeroContacto', 'Correo', 'Direccion'];
        foreach ($Campos as $item) {
            $Proveedor->$item = $request->$item;
        }
        $Proveedor->save();
        return redirect('proveedor/listar/2');
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
