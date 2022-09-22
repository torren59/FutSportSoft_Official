<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Compras.proveedores');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = Validator::make($request->all(), 
        ['NombreEmpresa'=>'min:1|unique:proveedores,NombreEmpresa|max:100','Titular'=>'min:1|max:100','NumeroContacto'=>'min:1|max:15','Correo'=>'min:1|max:70','Direccion'=>'min:1|unique:proveedores,Direccion|max:100'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        // ,'Municipio'=>70,'Barrio'=>70,'Direccion'=>100
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $Proveedor = new Proveedor();
        $Nit = $Proveedor::creadorPK($Proveedor,100);
        $Proveedor->Nit = $Nit;
        $Campos = ['NombreEmpresa','Titular','NumeroContacto','Correo','Direccion'];
        foreach($Campos as $item){
            $Proveedor->$item = $request->$item;
        }

        $Proveedor->save();
        return redirect('proveedor/listar');
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
        //
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
        //
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
