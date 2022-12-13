@extends('../layouts/home')



@section('title', 'Ventas')

@push('styles')
    {{-- Csrf para funcionamiento de Ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    {{-- Listado --}}

    <div class="service_list">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de ventas</h1>
            </div>
        </center>
        <br>

        @if (in_array(131, $permisos))
            <div class="addbtn">
                <a href=" {{ url('venta/crear') }} ">
                    <button class="btn btn-outline-secondary col-12" onclick="switchadicion2('ventaadicion')">Nueva Venta <i
                            class="fa-solid fa-circle-plus"></i></button>
                </a>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>VentaId</td>
                    <td>Documento</td>
                    <td>Fecha Venta</td>
                    <td>Valor Venta</td>
                    <td>SubTotal</td>
                    <td>Iva</td>
                    <td>Descuento</td>
                    <td>Estado</td>

                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td>
                            @if (in_array(118, $permisos))
                                <a href="{{ url('venta/getDetalle/' . $item->VentaId) }}"><button
                                        class="btn btn-outline-primary"><i class="fa-solid fa-circle-info"></i></button></a>
                            @endif
                        </td>
                        <td>{{ $item->VentaId }}</td>
                        <td>{{ $item->Documento }}</td>
                        <td> {{ $item->FechaVenta }} </td>
                        <td> {{ $item->ValorVenta }} </td>
                        <td> {{ $item->SubTotal }} </td>
                        <td> {{ $item->Iva }} </td>
                        <td> {{ $item->Descuento }} </td>
                        <td>
                            @if (in_array(155, $permisos))
                                {{-- Definiendo estado --}}
                                @if ($item->Estado == true)
                                <div  id="check_{{ $item->VentaId }}">
                                    <div class="form-check form-switch" >
                                        <input class="form-check-input" type="checkbox" role="switch" checked
                                            onclick="tryChange({{ $item->VentaId }})">
                                    </div>
                                </div>
                                @else
                                    <div>
                                        <button disabled class="btn btn-danger btn-sm">Cancelada</button>
                                    </div>
                                @endif
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    {{-- Detalles --}}

    <div id="detalleventa" class="adicion_off" style="width:600px;height:400px">
        <div class="floatcontent">

            <h1 style="padding-top:5%;">Detalles de la Venta</h1>
            <div id="jsPrint">
                {{-- Aquí se imprime el contenido de detalles enviado desde JS --}}
            </div>
            <button type="button" class="btn btn-outline-secondary"
                onclick="switchadicion2('detalleventa')">Cerrar</i></button>

        </div>
    </div>

    {{-- Mensajes personalizados --}}
    @if (isset($sweet_setAll))
        <script>
            setTimeout(() => {
                swal_setAll("{{ $sweet_setAll['title'] }}", "{{ $sweet_setAll['msg'] }}",
                    "{{ $sweet_setAll['type'] }}");
            }, 500);
        </script>
    @endif

@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/Ventas/ventaestado.js') }} "></script>
@endpush
