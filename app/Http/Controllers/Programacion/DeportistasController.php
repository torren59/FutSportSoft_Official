<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Acudiente;
use App\Models\Programacion\Deportista;
use App\Models\Programacion\tipo_documento;
use App\Rules\customRuleDeportistas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class DeportistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Deportista = new Deportista();
        $ListadoDeportista = $Deportista->all();
        return view('Programacion.deportistas')->with('listado',$ListadoDeportista);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), 
        ['Documento'=>'min:1|unique:deportistas,Documento|max:10','DocumentoAcudiente'=>'min:1|unique:deportistas,DocumentoAcudiente|max:10','TipoDocumento'=>'min:1|max:4','Nombre'=>'min:1|max:100','FechaNacimiento'=>'min:1|max:10','Direccion'=>'min:1|unique:deportistas,Direccion|max:80','Celular'=>'min:1|max:11','Correo'=>'min:1|max:70','UltimoPago'=>'min:1|max:10'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
       
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $Deportista = new Deportista();
        $Campos = ['Documento','DocumentoAcudiente','TipoDocumento','Nombre','FechaNacimiento','Direccion','Celular','Correo','UltimoPago'];
        foreach($Campos as $item){
            $Deportista->$item = $request->$item;
        }

        $Acudiente = new Acudiente();
        $Campos = ['DocumentoAcudiente','NombreAcudiente','CorreoAcudiente','CelularAcudiente'];
        foreach($Campos as $item){
            $Acudiente->$item = $request->$item;
        }

        $Deportista->save();
        return redirect('deportista/listar');
    }
    */

    public function create(){
        $TiposDocumentos = tipo_documento::all();
        $TiposDocumentosAcc = tipo_documento::all()->where('TipoDocumento','!=',3);
        $Acudientes = Acudiente::all();
        return view('Programacion.creardeportista')->with('TiposDoc',$TiposDocumentos)->with('TipoDocAcc',$TiposDocumentosAcc)
        ->with('Acudientes',$Acudientes);
    }

    public function saveData(Request $request){



        $validator = Validator::make(
            $request->all(),
            [
                'Nombre' => ['required','max_digits:50'],
                'TipoDocumento' => ['required'],
                'Documento' => ['required','max_digits:10', new customRuleDeportistas],
                'FechaNacimiento' => ['required'],
                'Celular' => ['required','numeric','max_digits:13'],
                'Direccion' => ['required','max_digits:80'],
                'howAcc' => ['required']
            ],
            [
                'required' => 'Evite enviar este campo vacío',
                'max_digits' => 'Campo excede los :max carácteres máximos',
                'numeric' => 'Este campo SOLO acepta números'
            ]
        );

        if(isset($request->newAcc)){
            return $request->all();
        }

        if($validator->fails()){
            return redirect('deportista/crear')->withErrors($validator)->withInput();
        }

        $Ba = 0;
        switch($Ba){
            case 1:
                return 'Nuevo acudiente';
            break;
            case 2:
                return 'Guardar Ya';
            break;
            case 3:
                return 'Seleccionar acudiente';
            break;
        }
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

    public function changeState(Request $request){
        $Documento = json_decode($request->Documento);
        $deportista = deportista::find($Documento);
        
        if($deportista->Estado == true){
            $deportista->Estado = false;
        }
        else{
            $deportista->Estado = true;
        }

        $deportista->save();

        return json_encode($deportista);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Selected =  Deportista::all()->where('Documento','=',$id);
        return view('Programacion.editardeportista')->with('deportistadata',$Selected);
        return $Selected;
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
        ['DocumentoAcudiente'=>'required|max:11','TipoDocumento'=>'required|max:5','Nombre'=>'required|max:100','FechaNacimiento'=>'required|max:10','Direccion'=>'required|max:80','Celular'=>'required|max:11','Correo'=>'required|max:70','UltimoPago'=>'required|max:10'],
        ['required'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
       
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
            
        }
        $Deportista = Deportista::find($id);
        $Campos = ['DocumentoAcudiente','TipoDocumento','Nombre','FechaNacimiento','Direccion','Celular','Correo','UltimoPago'];
        foreach($Campos as $item){
            $Deportista->$item = $request->$item;
        }
        $Deportista->save();
        return redirect('deportista/listar');
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
