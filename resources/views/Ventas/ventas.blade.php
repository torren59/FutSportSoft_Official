@extends('../layouts/home')



@section('title', 'Ventas')

@push('styles')
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
                <h1>VENTAS</h1>
            </div>
        </center>
        <br>

        <a href=" {{ url('venta/crear') }} ">
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2">Nueva Venta <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        </a>

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
                        <td><a href="{{ url('venta/editar/' . $item->VentaId) }}"><button class="btn btn-primary"><i
                                        class="fa-solid fa-pen"></i></button></a></td>
                        <td>{{ $item->VentaId }}</td>
                        <td>{{ $item->Documento }}</td>
                        <td> {{ $item->FechaVenta }} </td>
                        <td> {{ $item->ValorVenta }} </td>
                        <td> {{ $item->SubTotal }} </td>
                        <td> {{ $item->Iva }} </td>
                        <td> {{ $item->Descuento }} </td>
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
                                    {{ $checkstate }} >
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>


        

    </div>
@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush
