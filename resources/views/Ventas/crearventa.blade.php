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

                        <div class="grid_span_1 pointer_disable">
                            <h1>Productos</h1>
                            <div class="Container_Card_Venta">



                                @foreach ($productos as $item)
                                    <div class="Manual_Card" id="Card_{{ $item->ProductoId }}">

                                        <div class="Card_Data">
                                            <input type="hidden" id="ProductoId" readonly
                                                value=" {{ $item->ProductoId }} ">
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

                                        <div class="Card_Options_disable">
                                            <div class="Card_Total_Orders">
                                                Total Ordenados
                                            </div>

                                            <div class="Card_Edit_Option">

                                                <button class="btn btn-outline-primary">Editar</button>
                                            </div>

                                            <div class="Card_Quit_Option">

                                                <button class="btn btn-outline-danger">Quitar</button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                                @for ($i = 0; $i < 40; $i++)
                                    <div class="Manual_Card">

                                        <div class="Card_Data">
                                            <h6>Hola</h6>
                                        </div>

                                        <div class="Card_Options">
                                            <div class="Card_Total_Orders">
                                                Total Ordenados
                                            </div>

                                            <div class="Card_Edit_Option">

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
                aaa
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
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
@endpush
