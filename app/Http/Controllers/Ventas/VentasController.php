<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Compras\articulo_comprado;
use App\Models\Compras\Producto;
use App\Models\Programacion\Deporte;
use App\Models\Programacion\Deportista;
use App\Models\Ventas\Articulo_Vendido;
use App\Models\Ventas\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ListadoVenta = Venta::all();
        return view('Ventas.ventas')->with('listado', $ListadoVenta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $Productos = Producto::select(['ProductoId', 'NombreProducto', 'TipoProducto', 'Talla', 'PrecioVenta', 'Cantidad', 'proveedores.NombreEmpresa'])
            ->join('proveedores', 'proveedores.Nit', '=', 'productos.Nit')
            ->get();
        // ->where('productos.Estado','=',1)

        $Deportistas = Deportista::select(['Documento','Nombre'])
        ->get();

        $Info = ['Productos'=>$Productos, 'Deportistas' => $Deportistas];

        if(session()->has('VentaSession')){
            session()->forget('VentaSession');
        }
        return view('Ventas.crearventa')->with('Info', $Info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // GUARDANDO VENTA
        $Venta = new Venta();
        $VentaSession = session('VentaSession');
        $IdVenta = Venta::creadorPK($Venta, 100000);
        $Descuento = $request->Descuento;
        (strlen($Descuento) < 1) ? $Descuento = 0: $Descuento = $Descuento;
        $Documento = $request->Documento;

        // Rescatando datos de la sesión
        $VentaSession = session('VentaSession');
        $Articulos = $VentaSession[0]['Articulos'];
        $VentaData = $VentaSession[0]['VentaData'];

        // Asignando valores finales
        $Iva = intval($VentaData['Total']) - intval($VentaData['SubTotal']);
        $FinalTotal = intval($VentaData['Total']) - intval($Descuento);
        $FinalSubTotal = intval($VentaData['SubTotal']) - intval($Descuento);
        $Venta->VentaId = $IdVenta;
        $Venta->Documento = $Documento;
        $Venta->FechaVenta = date('Y-m-d');
        $Venta->ValorVenta = $FinalTotal;
        $Venta->SubTotal = $FinalSubTotal;
        $Venta->Iva = $Iva;
        $Venta->Descuento = $Descuento;

        $Venta->save();

        // GUARDANDO ARTICULOS
        $ArticulosObj = new Articulo_Vendido();
        $Llaves = array_keys($Articulos);
        $i = 0;
        $Cant = [];
        // foreach($Articulos as $item){
        //     $ArticulosObj->ArticulosVendidosId = Articulo_Vendido::creadorPK($ArticulosObj, 10000000);
        //     $ArticulosObj->ProductoId = $Llaves[$i];
        //     $ArticulosObj->VentaId = $IdVenta;
        //     $ArticulosObj->Cantidad = $item['Orden'];
        //     $PrecioVenta = Producto::select(['PrecioVenta'])->where('ProductoId', '=', $Llaves[$i])->get();
        //     $ArticulosObj->PrecioVenta = $PrecioVenta[0]['PrecioVenta'];
        //     $ArticulosObj->save();
        //     $i += 1;
        // }

    //   return redirect('venta/listar');

    foreach($Articulos as $item){
        $Cant = $item[$Llaves[$i]]['Cantidad'];
        $i += 1;
    }
    
    return $Cant;
    }


    public function listselected(Request $request)
    {
        $ProductModel = new Producto();
        $Selecteds = json_decode($request->seleccionados);
        $checkeds = $ProductModel->whereIn('ProductoId', $Selecteds)->select('NombreProducto')->get();
        return json_encode($checkeds);
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
        $Selected =  Venta::all()->where('VentaId', '=', $id);
        return view('Ventas.editarventas')->with('ventadata', $Selected);
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
            ['Documento' => 'min:1|unique:ventas,Documento|max:11', 'FechaVenta' => 'min:1|max:20', 'ValorVenta' => 'min:1|max:20', 'SubTotal' => 'min:1|unique:ventas,SubTotal|max:20', 'IVA' => 'min:1|max:20', 'Descuento' => 'min:1|max:20'],
            ['unique' => 'Este campo no acepta información que ya se ha registrado', 'min' => 'No puedes enviar este campo vacío', 'max' => 'Máximo de :max dígitos']
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $venta = Venta::find($id);
        $Campos = ['Documento', 'FechaVenta', 'ValorVenta', 'SubTotal', 'IVA', 'Descuento'];
        foreach ($Campos as $item) {
            $venta->$item = $request->$item;
        }
        $venta->save();
        return redirect('venta/listar');
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

    // Área de adición de producto

    /**
     * @var ProductoId
     * @var Cantidad
     * 
     * @return Total
     */
    private function getTotalProducto($ProductoId, $Cantidad)
    {
        $PrecioVenta = 0;
        $Consulta = Producto::select(['PrecioVenta'])
            ->where('ProductoId', '=', $ProductoId)->get();

        foreach ($Consulta as $item) {
            $PrecioVenta = $item->PrecioVenta;
        }

        $IntPrecioVenta = intval($PrecioVenta);
        $IntCantidad = intval($Cantidad);

        $Total = $IntPrecioVenta * $IntCantidad;
        return $Total;
    }

    private function getSubTotalProducto($Total)
    {
        $SubTotal = $Total - ($Total * 0.19);
        return $SubTotal;
    }

    public function letSes(){
        $VentaSession = session('VentaSession');
        // $br = [];
        // foreach($VentaSession as $item){
        //     $br += $item;
        // }
        return $VentaSession[0];
    }

    public function addProducto(Request $request)
    {
        // Definir variables
        $VentaSession = [];
        $Articulos = [];
        $VentaData = [];
        $Total = 0;
        $SubTotal = 0;

        // Rescatar ID y Cantidad
        $ProductoId = json_decode($request->ProductoId);
        $Orden = json_decode($request->Orden);

        // Determinar total y subtotal para el producto
        $PrecioTotalProducto = $this->getTotalProducto($ProductoId, $Orden);
        $SubTotalProducto = $this->getSubTotalProducto($PrecioTotalProducto);

        if(session()->missing('VentaSession')){

            // Adición del primer producto
            $Total += intval($PrecioTotalProducto);
            $SubTotal += intval($SubTotalProducto);

            // Guardando total y subtotal general & Agregando producto
            $VentaData['Total'] = $Total;
            $VentaData['SubTotal'] = $SubTotal;
            $Articulos[$ProductoId] = ['Orden' => $Orden, 'Total' => $PrecioTotalProducto, 'SubTotal' => $SubTotalProducto];

            // Guardando VentaData y Articulos
            $VentaSession[0]['Articulos'] = $Articulos;
            $VentaSession[0]['VentaData'] = $VentaData;
            session(['VentaSession' => $VentaSession]);
            return $VentaSession;
        }

        else{
            // Rescatando datos de la sesión
            $VentaSession = session('VentaSession');
            $Articulos = $VentaSession[0]['Articulos'];
            $VentaData = $VentaSession[0]['VentaData'];
            
            // Rescatando total y subtotal general
            $Total = $VentaData['Total'];
            $SubTotal = $VentaData['SubTotal'];
           
            // Recalculando total y subtotal general
            $Total += intval($PrecioTotalProducto);
            $SubTotal += intval($SubTotalProducto);

            // Reemplazando total y subtotal general & Agregando producto
            $VentaData['Total'] = $Total;
            $VentaData['SubTotal'] = $SubTotal;
            $Articulos[$ProductoId] = ['Orden' => $Orden, 'Total' => $PrecioTotalProducto, 'SubTotal' => $SubTotalProducto];

            // Reemplazando VentaData y Articulos
            $VentaSession[0]['Articulos'] = $Articulos;
            $VentaSession[0]['VentaData'] = $VentaData;
            session()->forget('VentaSession');
            session(['VentaSession' => $VentaSession]);
            return $VentaSession;
        }
    }

    public function deleteProducto(Request $request){

        // Rescatar ID
        $ProductoId = json_decode($request->ProductoId);

        // Definir variables
        $VentaSession = [];
        $Articulos = [];
        $VentaData = [];
        $Total = 0;
        $SubTotal = 0;

        //Rescatando datos de la Sesion
        $VentaSession = session('VentaSession');
        $Articulos = $VentaSession[0]['Articulos'];
        $VentaData = $VentaSession[0]['VentaData'];

        // Rescatando total y subtotal general
        $Total = $VentaData['Total'];
        $SubTotal = $VentaData['SubTotal'];

        // Rescatando articulo a eliminar y modificando total y subtotal
        $Total -= $Articulos[$ProductoId]['Total'];
        $SubTotal -= $Articulos[$ProductoId]['SubTotal'];

        // Reemplazando total y subtotal general & Retirando producto
        $VentaData['Total'] = $Total;
        $VentaData['SubTotal'] = $SubTotal;
        unset($Articulos[$ProductoId]);

        // Reemplazando VentaData y Articulos
        $VentaSession[0]['Articulos'] = $Articulos;
        $VentaSession[0]['VentaData'] = $VentaData;
        session()->forget('VentaSession');
        session(['VentaSession' => $VentaSession]);
        if(count($Articulos) == 0){
            session()->forget('VentaSession');
        }
        return $VentaSession;
    }

    public function elim(){
        session()->forget('VentaSession');
    }

    public function getFacturacion(Request $request){
        if(session()->has('VentaSession')){
            $VentaData = session('VentaSession');
            return $VentaData;
        }
        return json_encode(0);
    }
}
