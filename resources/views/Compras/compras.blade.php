@extends('../layouts/home')

@section('title', 'Compras')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>

@endpush

@section('content')




    <div class="service_list" id="listadocompra">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de Compras</h1>
            </div>
        </center>
        <br>
        <a href="{{ url('compras/crear/') }}">
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('roladicion')">Crear <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        </a>
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
                @foreach ($listado as $item)
                    <tr>
                        <td><abbr title="Detalles"><button type="button" class="btn btn-outline-secondary" onclick="detalleCompras({{$item->NumeroFactura}},'detallecompra','jsPrint')"><i
                                        class="fa-solid fa-circle-info"></i></button></abbr>
                        </td>
                        <td>{{ $item->NumeroFactura }}</td>
                        <td>{{ $item->Nit }}</td>
                        <td>{{ $item->FechaCompra }}</td>
                        <td>{{ $item->ValorCompra }}</td>


                        <td>
                            {{-- Definiendo estado --}}
                            @php
                                $checkstate = '';
                                if ($item->Estado == true) {
                                    $checkstate = 'checked';
                                }
                            @endphp

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                    {{ $checkstate }}>
                            </div>
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
            <button type="button" class="btn btn-primary btn-danger"
                        onclick="switchadicion2('detallecompra')">Cerrar</i></button>
                    
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
