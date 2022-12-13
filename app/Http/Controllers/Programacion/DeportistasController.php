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
    public function index($status = null)
    {
        $ListadoDeportista = Deportista::select(['Documento', 'acudientes.NombreAcudiente','tipos_documentos.Descripcion as TipoDocumento','Nombre',
        'FechaNacimiento','Direccion','Celular','Correo','Estado'])
        ->join('acudientes','acudientes.DocumentoAcudiente','=','deportistas.DocumentoAcudiente')
        ->join('tipos_documentos','tipos_documentos.TipoDocumento','=','deportistas.TipoDocumento')
        ->get();

        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('Programacion.deportistas')->with('listado',$ListadoDeportista)->with('sweet_setAll', $sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title' => 'Registro editado', 'msg' => 'El registro se editó exitosamente', 'type' => 'success'];
                return view('Programacion.deportistas')->with('listado',$ListadoDeportista)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
            return view('Programacion.deportistas')->with('listado',$ListadoDeportista);
            break;
        }

    }

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
                'Nombre' => ['required','max:50'],
                'TipoDocumento' => ['required'],
                'Documento' => ['required','max_digits:10', new customRuleDeportistas],
                'FechaNacimiento' => ['required'],
                'Celular' => ['required','numeric','max_digits:13'],
                'Direccion' => ['required','max:80'],
                'Correo' => ['required','max:50'],
                'howAcc' => ['required'],
                'TipoDocumentoAcc' => ['exclude_unless:howAcc,newAccTab','required'],
                'DocumentoAcc' => ['exclude_unless:howAcc,newAccTab','required','max_digits:10', new customRuleDeportistas],
                'NombreAcc' => ['exclude_unless:howAcc,newAccTab','required','max:50'],
                'CelularAcc' => ['exclude_unless:howAcc,newAccTab','numeric','max_digits:13'],
                'CorreoAcc' => ['exclude_unless:howAcc,newAccTab','required','max:50'],
                'CurrentDocumentoAcc' => ['exclude_unless:howAcc,choiceAccTab','required']
            ],
            [
                'required' => 'Evite enviar este campo vacío',
                'max' => 'Campo excede los :max carácteres máximos',
                'max_digits' => 'Campo excede los :max carácteres máximos',
                'numeric' => 'Este campo SOLO acepta números'
            ]
        );

        if($validator->fails()){
            return redirect('deportista/crear')->withErrors($validator)->withInput();
        }

        $deportista = new Deportista();
        if($request->howAcc == 'noAccTab'){
            $campos = ['Nombre','TipoDocumento','Documento','FechaNacimiento','Celular','Direccion','Correo'];
            foreach($campos as $campo){
                $deportista->$campo = $request->$campo;
            }
            $deportista->DocumentoAcudiente = '10001';
            $deportista->save();
            return redirect('deportista/listar/1');
        }

        if($request->howAcc == 'newAccTab'){
            $acudiente = new Acudiente();
            $acudiente->DocumentoAcudiente = $request->DocumentoAcc;
            $acudiente->TipoDocumento = $request->TipoDocumentoAcc;
            $acudiente->NombreAcudiente = $request->NombreAcc;
            $acudiente->CorreoAcudiente = $request->CorreoAcc;
            $acudiente->CelularAcudiente = $request->CelularAcc;
            $acudiente->save();

            $campos = ['Nombre','TipoDocumento','Documento','FechaNacimiento','Celular','Direccion','Correo'];
            foreach($campos as $campo){
                $deportista->$campo = $request->$campo;
            }
            $deportista->DocumentoAcudiente = $request->DocumentoAcc;
            $deportista->save();
            return redirect('deportista/listar/1');
        }

        if($request->howAcc == 'choiceAccTab'){
            $campos = ['Nombre','TipoDocumento','Documento','FechaNacimiento','Celular','Direccion','Correo'];
            foreach($campos as $campo){
                $deportista->$campo = $request->$campo;
            }
            $deportista->DocumentoAcudiente = $request->CurrentDocumentoAcc;
            $deportista->save();
            return redirect('deportista/listar/1');
        }


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
        $Selected = Deportista::select(['Documento','deportistas.DocumentoAcudiente','Nombre','FechaNacimiento','Direccion',
        'Celular','Correo','acudientes.NombreAcudiente','acudientes.CorreoAcudiente','acudientes.CelularAcudiente'])
        ->join('acudientes','acudientes.DocumentoAcudiente','=','deportistas.DocumentoAcudiente')
        ->get();

        // return $Selected;

        $Acudientes = Acudiente::all();

        $TiposDocumentosAcc = tipo_documento::all()->where('TipoDocumento','!=',3);

        return view('Programacion.editardeportista')->with('deportistaData',$Selected)
        ->with('Acudientes',$Acudientes)->with('TipoDocAcc',$TiposDocumentosAcc);
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

        $validator = Validator::make(
            $request->all(),
            [
                'Nombre' => ['required','max:50'],
                'FechaNacimiento' => ['required'],
                'Celular' => ['required','numeric','max_digits:13'],
                'Direccion' => ['required','max:80'],
                'Correo' => ['required','max:50'],
                'howAcc' => ['required'],
                'TipoDocumentoAcc' => ['exclude_unless:howAcc,newAccTab','required'],
                'DocumentoAcc' => ['exclude_unless:howAcc,newAccTab','required','max_digits:10', new customRuleDeportistas],
                'NombreAcc' => ['exclude_unless:howAcc,newAccTab','required','max:50'],
                'CelularAcc' => ['exclude_unless:howAcc,newAccTab','numeric','max_digits:13'],
                'CorreoAcc' => ['exclude_unless:howAcc,newAccTab','required','max:50'],
                'CurrentDocumentoAcc' => ['exclude_unless:howAcc,choiceAccTab','required']
            ],
            [
                'required' => 'Evite enviar este campo vacío',
                'max' => 'Campo excede los :max carácteres máximos',
                'max_digits' => 'Campo excede los :max carácteres máximos',
                'numeric' => 'Este campo SOLO acepta números'
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $deportista = Deportista::find($request->Documento);

        if($request->howAcc == 'newAccTab'){
            $acudiente = new Acudiente();
            $acudiente->DocumentoAcudiente = $request->DocumentoAcc;
            $acudiente->TipoDocumento = $request->TipoDocumentoAcc;
            $acudiente->NombreAcudiente = $request->NombreAcc;
            $acudiente->CorreoAcudiente = $request->CorreoAcc;
            $acudiente->CelularAcudiente = $request->CelularAcc;
            $acudiente->save();

            $campos = ['Nombre','FechaNacimiento','Celular','Direccion','Correo'];
            foreach($campos as $campo){
                $deportista->$campo = $request->$campo;
            }
            $deportista->DocumentoAcudiente = $request->DocumentoAcc;
            $deportista->save();
            return redirect('deportista/listar/2');
        }

        if($request->howAcc == 'choiceAccTab'){
            $campos = ['Nombre','FechaNacimiento','Celular','Direccion','Correo'];
            foreach($campos as $campo){
                $deportista->$campo = $request->$campo;
            }
            $deportista->DocumentoAcudiente = $request->CurrentDocumentoAcc;
            $deportista->save();
            return redirect('deportista/listar/2');
        }
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

    public function getDetalle($id){
        $ListadoDeportista = Deportista::select(['Documento','acudientes.DocumentoAcudiente','acudientes.NombreAcudiente',
        'acudientes.CorreoAcudiente','acudientes.CelularAcudiente','tipos_documentos.Descripcion','Nombre',
        'FechaNacimiento','Direccion','Celular','Correo','Estado'])
        ->join('acudientes','acudientes.DocumentoAcudiente','=','deportistas.DocumentoAcudiente')
        ->join('tipos_documentos','tipos_documentos.TipoDocumento','=','deportistas.TipoDocumento')
        ->where('Documento','=',$id)
        ->get();

        // return $ListadoDeportista;
        return view('Programacion.detalledeportista')->with('listadoDeportista',$ListadoDeportista);
    }
}
