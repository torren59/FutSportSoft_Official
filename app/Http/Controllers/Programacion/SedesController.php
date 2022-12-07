<?php
namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use App\Models\Programacion\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SedesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $ListadoSede = Sede::all();
        switch($status){
            case 1:
                $sweet_setAll = ['title'=>'Registro guardado', 'msg'=>'El registro se guardó exitosamente', 'type'=>'success'];
                return view('Programacion.Sedes')->with('listado',$ListadoSede)->with('sweet_setAll',$sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title'=>'Registro editado', 'msg'=>'El registro se editó exitosamente', 'type'=>'success'];
                return view('Programacion.Sedes')->with('listado',$ListadoSede)->with('sweet_setAll',$sweet_setAll);
                break;
            default:
            return view('Programacion.Sedes')->with('listado',$ListadoSede);
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
        $validator = Validator::make($request->all(),
        ['NombreSede'=>'min:1|unique:sedes,NombreSede|max:50','Municipio'=>'min:1|max:70','Barrio'=>'min:1|max:70','Direccion'=>'min:1|unique:sedes,Direccion|max:100'],
        ['unique'=>'* Este campo no acepta información que ya se ha registrado','min'=>'* No puedes enviar este campo vacío','max'=>'* Máximo de :max dígitos']);

        if($validator->fails()){
            return redirect('sede/listar')->withErrors($validator)->withInput();
        }
        $Sede = new Sede();
        $id = Sede::creadorPK($Sede,100);
        $Sede->SedeId = $id;
        $Campos = ['NombreSede','Municipio','Barrio','Direccion'];
        foreach($Campos as $item){
            $Sede->$item = $request->$item;
        }

        $Sede->save();
        return redirect('sede/listar/1');
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
        $SedeId = json_decode($request->SedeId);
        $sede = Sede::find($SedeId);

        if($sede->Estado == false){
            $sede->Estado = true;
        }
        else{
            $sede->Estado = false;
        }
        $sede->save();

        $Estado = ['Estado'=>$request->Estado];
        return json_encode($Estado);
    }

    public function canChange(Request $request){
        $SedeId = json_decode($request->SedeId);
        $Sedes = Sede::select(['programacion.ProgramacionId','sedes.NombreSede'])
        ->join('programacion','sedes.SedeId','=','programacion.SedeId')
        ->where('sedes.SedeId','=',intval($SedeId))
        ->where('programacion.Estado','=',true)
        ->get();

        return json_encode($Sedes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Selected =  Sede::all()->where('SedeId','=',$id);
        return view('Programacion.editarsede')->with('sededata',$Selected);
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
        session(['SedeId' => $id]);
        $validator = Validator::make($request->all(),
        ['NombreSede'=>['min:1',
        function ($attribute, $value, $fail) {
            $id = session('SedeId');
            $outRegisterItem = Sede::where('NombreSede', '=', $value)
                ->where('SedeId', '!=', $id)->count();
            if ($outRegisterItem > 0) {
                return $fail($attribute . ' ya está registrado para otra sede');
            }
        },
        'max:50'],'Municipio'=>'min:1|max:70','Barrio'=>'min:1|max:70','Direccion'=>['min:1',
        function ($attribute, $value, $fail) {
            $id = session('SedeId');
            $outRegisterItem = Sede::where('Direccion', '=', $value)
                ->where('SedeId', '!=', $id)->count();
            if ($outRegisterItem > 0) {
                return $fail($attribute . ' ya está registrado para otra sede');
            }
        }
        ,'max:50']],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
        session()->forget('SedeId');
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }
        $sede = Sede::find($id);
        $Campos = ['NombreSede','Municipio','Barrio','Direccion'];
        foreach($Campos as $item){
            $sede->$item = $request->$item;
        }
        $sede->save();
        return redirect('sede/listar/2');
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
