@extends('../layouts/home')

@section('title', 'Compras')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
@endpush

@section('content')




    <div class="service_list" id="listadocompra">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de Compras</h1>
            </div>
        </center>
        <br>

        @if (in_array(121, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('selectproveedor')">Crear <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Numero de Factura</td>
                    <td>Nit</td>
                    <td>Fecha de la Compra</td>
                    <td>Valor de la Compra</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado['ListadoCompras'] as $item)
                    <tr>
                        <td>
                            @if (in_array(116, $permisos))
                                <abbr title="Detalles"><button type="button" class="btn btn-outline-secondary"
                                        onclick="detalleCompras({{ $item->NumeroFactura }},'detallecompra','jsPrint')"><i
                                            class="fa-solid fa-circle-info"></i></button></abbr>
                            @endif
                        </td>
                        <td>{{ $item->NumeroFactura }}</td>
                        <td>{{ $item->NombreEmpresa }}</td>
                        <td>{{ $item->FechaCompra }}</td>
                        <td>{{ $item->ValorCompra }}</td>


                        <td>
                            @if (in_array(145, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" {{ $checkstate }}>
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    </div>

    {{-- Detalles --}}

    <div id="detallecompra" class="adicion_off" style="width:600px;height:400px">
        <div class="floatcontent">

            <h1 style="padding-top:5%;">Detalles de la Compra</h1>
            <div id="jsPrint">
                {{-- Aquí se imprime el contenido de detalles enviado desde JS --}}
            </div>
            <div class="boton detalle p-5">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="switchadicion2('detallecompra')">Cerrar</i></button>
            </div>

        </div>
    </div>

    {{-- modal para proveedores --}}

    <div id="selectproveedor" class="adicion_off" style="width:600px;height:400px">
        <div class="floatcontent">

            <h1 style="padding-top:5%;">Seleccionar proveedor</h1>
            <form action="/compras/crearproveedor" method="post"> @csrf
                <div class="col-6">
                    <label for="proveedores" class="form-label">Proveedores</label>
                    <select name="Nit" class="form-select" aria-label="Default select example">
                        <option selected>Selecione un Proveedor</option>
                        @foreach ($listado['ListadoProveedor'] as $item)
                            <option value="{{ $item->Nit }}">{{ $item->NombreEmpresa }}</option>
                        @endforeach
                    </select>

                    <button type="submit">Enviar</button>
                </div>
                <button type="button" class="btn btn-outline-secondary"
                    onclick="switchadicion2('selectproveedor')">Cerrar</i></button>
            </form>
        </div>
    </div>
@endsection





@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>


    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
@endpush
