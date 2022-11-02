@extends('../layouts/home')

@section('title', 'Crear venta')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

    <div class="service_list">
        <form action="/venta/store" method="post">
            @csrf
            <div class="grid_triple_center">
                <div class="grid_span_2a3">

                    <div class="grid_doble_superderecha2">

                        <div class="grid_span_1" id="product_added">
                            <div>
                                <h3>Nueva Venta</h3>
                            </div>
                            <div class="col-12 lista_selects">
                                {{-- Aqui se inserta con js los productos seleccionados --}}
                            </div>
                        </div>

                        <div class="grid_span_1" id="Products_Zone">
                            <h1>Productos</h1>
                            <div class="Container_Card_Venta">



                                @foreach ($productos as $item)
                                    <div class="Manual_Card" id="Card_{{$item->ProductoId}}"
                                        onclick="addProduct(' {{ $item->ProductoId }} ','{{ $item->NombreProducto }}',' {{ $item->Cantidad }}')">

                                        <div class="Card_Data">
                                            <label class="label-control One_In_Flex" style="border: 1px solid green;">
                                                Proveedor: {{ $item->NombreEmpresa }}
                                            </label>
                                            <label class="label-control One_In_Flex" style="border: 1px solid green;">
                                                Producto: {{ $item->NombreProducto }}
                                            </label>
                                            <label class="label-control One_In_Flex" style="border: 1px solid green;">
                                                Tipo: {{ $item->TipoProducto }}
                                            </label>
                                            <label class="label-control One_In_Flex" style="border: 1px solid green;">
                                                Talla: {{ $item->Talla }}
                                            </label>
                                            <label class="label-control One_In_Flex" style="border: 1px solid green;">
                                                Existencias: {{ $item->Cantidad }}
                                            </label>
                                            <label class="label-control One_In_Flex" style="border: 1px solid green;">
                                                Existencias: {{ $item->Cantidad }}
                                            </label>
                                            <label class="label-control One_In_Flex" style="border: 1px solid green;">
                                                Precio: {{ $item->PrecioVenta }}
                                            </label>
                                        </div>

                                        <div class="Card_Options_disable" id="Card_Options_{{$item->ProductoId}}" >
                                            <div class="Card_Total_Orders_Title">
                                                Total Ordenados
                                            </div>

                                            <div class="Card_Total_Orders" id="Card_Orden_{{$item->ProductoId}}">
                                              {{-- Aqui se imprime la cantidad ordenada --}}
                                            </div>

                                            <div class="Card_Quit_Option">
                                                <button type="button" class="btn btn-outline-danger" onclick="deleteProduct(' {{$item->ProductoId}} ')">Quitar</button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                                @for ($i = 0; $i < 40; $i++)
                                    <div class="Manual_Card">

                                        <div class="Card_Data">
                                            <h6>Hola</h6>
                                        </div>

                                        <div class="Card_Options_disable">
                                            <div class="Card_Total_Orders" id="Card_Orden_{{$item->ProductoId}}">
                                                Total Ordenados
                                            </div>

                                            <div class="Card_Edit_Option_disable">

                                                <button class="btn btn-outline-primary">Editar</button>
                                            </div>

                                            <div class="Card_Quit_Option">

                                                <button class="btn btn-outline-danger">Quitar</button>
                                            </div>
                                        </div>

                                    </div>
                                @endfor

                            </div>
                        </div>

                    </div>

                    <br>
                    <button type="submit">Enviar</button>

                </div>
            </div>



        </form>


        @if ($errors->any())
            <h1>Es necesario que cantidades y valores unitarios de los productos seleccionados tengan valores mínimos de 1 y
                0
                respectivamente</h1>
        @endif

        <button class="btn btn-primary" onclick="getArray()">getArray</button>

        {{-- Modal de total productos a ordenar --}}
        <div id="OrderProduct" class="adicion_off" style="width: 500px;height:250px;">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Total a ordenar</h4>

                <div class="col-12 row">
                    <div class="col-6">
                        <input type="hidden" id="ProductoId" readonly>
                        <label for="Product_Cantidad_Camp" class="form-label">Producto</label>
                        <input disabled type="text" class="form-control" id="Product_Name_Camp">
                    </div>
                    <div class="col-6">
                        <label for="Product_Cantidad_Camp" class="form-label">Existencias</label>
                        <input disabled type="text" class="form-control" id="Product_Cantidad_Camp">
                    </div>
                </div>

                <div class="col-12">
                    <label for="Orden" class="label-form">Total a ordenar</label>
                    <input type="number" class="form-control" name="Orden" id="Orden">
                </div>
                <div id="OrdenError">
                    {{-- Acá se imprime error en caso de validación  --}}
                </div>
                <br>

                <div class="col-12 row">
                    <div class="col-6">
                        <button class="btn btn-outline-success" onclick="saveProduct()">
                            Agregar
                        </button>
                    </div>
                    <div>
                        <a href=" {{url('venta/Elim')}} ">
                            <button class="btn btn-outline-success">
                                Regret
                            </button>
                        </a>
                    </div>
                    <div>
                        <a href=" {{ url('venta/bbbccc') }} "> <button class="btn btn-outline-success">
                                Watch
                            </button></a>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-outline-danger" onclick="cancelAddProduct('OrderProduct')">
                            Cancelar
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection

@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/Ventas/Ventas.js') }} "></script>
@endpush
