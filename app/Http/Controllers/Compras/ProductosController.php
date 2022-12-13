<?php

namespace App\Http\Controllers\Compras;

use App\Models\Compras\Producto;
use App\Models\Compras\Talla;
use App\Models\Compras\Tipo_Producto;
use App\Models\Compras\Proveedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $Productos = Producto::select('ProductoId','tipos_productos.Tipo','proveedores.NombreEmpresa','NombreProducto','tallas.Talla','PrecioVenta','Cantidad','productos.Estado')
        ->join('proveedores','proveedores.Nit','=','productos.Nit')
        ->join('tallas','tallas.TallaId','=','productos.Talla')
        ->join('tipos_productos','tipos_productos.TipoId','=','productos.TipoProducto')
        ->get();

        $tallas = Talla::all();
        $Proveedores = Proveedor::all()->where('Estado','=',true);
        $Tipos = Tipo_Producto::all();
// return $Productos;

        switch ($status) {
            case 1:
                $sweet_setAll = ['title' => 'Registro guardado', 'msg' => 'El registro se guardó exitosamente', 'type' => 'success'];
                return view('Compras.productos')->with('listado',$Productos)->with('tallas',$tallas)
                ->with('tipos_productos',$Tipos)->with('proveedores',$Proveedores)->with('sweet_setAll', $sweet_setAll);
                break;
            case 2:
                $sweet_setAll = ['title' => 'Registro editado', 'msg' => 'El registro se editó exitosamente', 'type' => 'success'];
                return view('Compras.productos')->with('listado',$Productos)->with('tallas',$tallas)
                ->with('tipos_productos',$Tipos)->with('proveedores',$Proveedores)->with('sweet_setAll', $sweet_setAll);
                break;
            default:
            return view('Compras.productos')->with('listado',$Productos)->with('tallas',$tallas)
        ->with('tipos_productos',$Tipos)->with('proveedores',$Proveedores);
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
        ['NombreProducto'=>'min:1|max:50','TipoProducto'=>'min:1|max:10','Talla'=>'min:1|max:6','PrecioVenta'=>'min:1|max:8','Cantidad'=>'min:1|max:4'],
        ['unique'=>'* Este campo no acepta información que ya se ha registrado','* min'=>'No puedes enviar este campo vacío','max'=>'* Máximo de :max dígitos']);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $Producto = new Producto();
        $id = $Producto::creadorPK($Producto,100);
        $Producto->ProductoId = $id;
        $Campos = ['Nit','NombreProducto','TipoProducto','Talla','PrecioVenta','Cantidad'];
        foreach($Campos as $item){
            $Producto->$item = $request->$item;
        }

        $Producto->save();
        return redirect('producto/listar/1');
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
        $ProductoId = json_decode($request->ProductoId);
        $Productos = Producto::find($ProductoId);

        if($Productos->Estado == true){
            $Productos->Estado = false;
        }
        else{
            $Productos->Estado = true;
        }

        $Productos->save();

        return json_encode($Productos);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Selected =   Producto::select('productos.Nit','TipoProducto','ProductoId','tipos_productos.Tipo','proveedores.NombreEmpresa','NombreProducto','tallas.Talla','PrecioVenta','Cantidad',)
        ->where('ProductoId','=',$id)
        ->join('proveedores','proveedores.Nit','=','productos.Nit')
        ->join('tallas','tallas.TallaId','=','productos.Talla')
        ->join('tipos_productos','tipos_productos.TipoId','=','productos.TipoProducto')
        ->get();
        $tallas = Talla::all();
        $Proveedores = Proveedor::all();
        $Tipos = Tipo_Producto::all();
        return view('Compras.editarproducto')->with('productodata',$Selected)->with('tallas',$tallas)
        ->with('tipos_productos',$Tipos)->with('proveedores',$Proveedores);
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
        ['Nit'=>'min:1|max:50','NombreProducto'=>'min:1|max:100','TipoProducto'=>'min:1|max:2','Talla'=>'min:1|max:6','PrecioVenta'=>'min:1|max:8','Cantidad'=>'min:1|max:4'],
        ['unique'=>'Este campo no acepta información que ya se ha registrado','min'=>'No puedes enviar este campo vacío','max'=>'Máximo de :max dígitos']);
// return $request->all();
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();

        }
        $Producto = Producto::find($id);
        $Campos = ['Nit','NombreProducto','TipoProducto','Talla','PrecioVenta','Cantidad'];
        foreach($Campos as $item){
            $Producto->$item = $request->$item;
        }
        $Producto->save();
        return redirect('producto/listar/2');

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
