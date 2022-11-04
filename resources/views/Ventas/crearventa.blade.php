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
                                <h1 class="title text-center">Nueva Venta</h1>
                            </div>

                            <div hidden>
                                <label for="Descuento" class="form-label">Descuento</label>
                                <input disabled type="number" name="Descuento" id="Descuento" class="form-control">
                            </div>

                            <div>
                                <label for="Deportista" class="form-label">Deportista</label>
                                <select name="Documento" class="form-select">

                                    @foreach ($Info['Deportistas'] as $item)
                                        <option value="{{ $item->Documento }}">{{ $item->Nombre }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div>
                                <label for="SubTotal" class="form-label">SubTotal</label>
                                <input disabled type="text" name="SubTotal" id="SubTotal" class="form-control">
                            </div>
                            <div>
                                <label for="Iva" class="form-label">Iva</label>
                                <input disabled type="text" name="Iva" id="Iva" class="form-control">
                            </div>
                            <div>
                                <label for="Total" class="form-label">Total</label>
                                <input disabled type="text" name="Total" id="Total" class="form-control">
                            </div>
                        </div>

                        <div class="grid_span_1" id="Products_Zone">
                            <h1>Productos</h1>
                            <div class="Container_Card_Venta">



                                @foreach ($Info['Productos'] as $item)
                                    <div class="Manual_Card" id="Card_{{ $item->ProductoId }}"
                                        onclick="addProduct(' {{ $item->ProductoId }} ','{{ $item->NombreProducto }}',' {{ $item->Cantidad }}')">

                                        <div class="Card_Data">
                                            <label class="label-control One_In_Flex">
                                                Proveedor: {{ $item->NombreEmpresa }}
                                            </label>
                                            <label class="label-control One_In_Flex">
                                                Producto: {{ $item->NombreProducto }}
                                            </label>
                                            <label class="label-control One_In_Flex">
                                                Tipo: {{ $item->TipoProducto }}
                                            </label>
                                            <label class="label-control One_In_Flex">
                                                Talla: {{ $item->Talla }}
                                            </label>
                                            <label class="label-control One_In_Flex">
                                                Existencias: {{ $item->Cantidad }}
                                            </label>
                                            <label class="label-control One_In_Flex">
                                                Existencias: {{ $item->Cantidad }}
                                            </label>
                                            <label class="label-control One_In_Flex">
                                                Precio: {{ $item->PrecioVenta }}
                                            </label>
                                        </div>

                                        <div class="Card_Options_disable" id="Card_Options_{{ $item->ProductoId }}">
                                            <div class="Card_Total_Orders_Title">
                                                Total Ordenados
                                            </div>

                                            <div class="Card_Total_Orders" id="Card_Orden_{{ $item->ProductoId }}">
                                                {{-- Aqui se imprime la cantidad ordenada --}}
                                            </div>

                                            <div class="Card_Quit_Option">
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="deleteProduct(' {{ $item->ProductoId }} ')">Quitar</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid_span_2a3">
                    <button type="button" class="btn btn-outline-success"
                        onclick="openConfirmationModal('ConfirmationModal')">Continuar</button>
                </div>
            </div>

                    {{-- Modal guardado de venta --}}
        <div id="SendButton" class="adicion_off" style="width: 500px;height:150px; background-color:white;">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Desear guardar esta venta</h4>
                <br>
                <div class="col-12 row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-outline-success">
                            Guardar
                        </button>
                    </div>

                    <div class="col-6">
                        <button type="button" class="btn btn-outline-danger" onclick="closeModal('SendButton')">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        </form>




        {{-- Modal de total productos a ordenar --}}
        <div id="OrderProduct" class="adicion_off" style="width: 500px;height:300px;">
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

                    <div class="col-6">
                        <button class="btn btn-outline-danger" onclick="cancelAddProduct('OrderProduct')">
                            Cancelar
                        </button>
                    </div>
                </div>

            </div>
        </div>

        {{-- Modal de confirmación --}}
        <div id="ConfirmationModal" class="adicion_off" style="width: 300px;height:500px;">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Confirmación</h4>

                <div>
                    <label for="SubTotal_On_Confirm" class="form-label">SubTotal</label>
                    <input disabled type="text" class="form-control" id="SubTotal_On_Confirm">
                </div>

                <div>
                    <label for="Iva_On_Confirm" class="form-label">Iva</label>
                    <input disabled type="text" class="form-control" id="Iva_On_Confirm">
                </div>

                <div>
                    <label for="Total_On_Confirm" class="form-label">Total</label>
                    <input disabled type="text" class="form-control" id="Total_On_Confirm">
                </div>

                <div>
                    <label for="Descuento_On_Confirm" class="form-label">Descuento</label>
                    <input type="number" class="form-control" id="Descuento_On_Confirm">
                </div>


                <div id="ConfirmationError">
                    {{-- Acá se imprime error en caso de validación  --}}
                </div>
                <br>

                <div class="col-12 row">
                    <div class="col-6">
                        <button class="btn btn-outline-success" onclick="openSendButton()">
                            Guardar
                        </button>
                    </div>

                    <div class="col-6">
                        <button class="btn btn-outline-danger" onclick="closeModal('ConfirmationModal')">
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
