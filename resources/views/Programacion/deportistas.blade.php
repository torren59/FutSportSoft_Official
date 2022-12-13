@extends('../layouts/home')



@section('title', 'Deportistas')

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
                <h1>DEPORTISTAS</h1>
            </div>
        </center>



        @if (in_array(126, $permisos))
            <a href=" {{ url('deportista/crear') }} ">
                <div class="addbtn">
                    <button class="btn btn-outline-secondary col-2">Nuevo Deportista <i
                            class="fa-solid fa-circle-plus"></i></button>
                </div>
            </a>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Documento</td>
                    <td>Nombre</td>
                    <td>Fecha de Nacimiento</td>
                    <td>Direccion</td>
                    <td>Celular</td>
                    <td>Correo</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td>
                            @if (in_array(138, $permisos))
                                <a href="{{ url('deportista/editar/' . $item->Documento) }}"><button
                                        class="btn btn-primary"><i class="fa-solid fa-pen"></i></button></a>
                            @endif
                            @if (in_array(156, $permisos))
                                <a href="{{ url('deportista/getDetalle/' . $item->Documento) }}"><button
                                        class="btn btn-primary"><i class="fa-solid fa-circle-info"></i></button></a>
                            @endif
                        </td>
                        <td>{{ $item->Documento }}</td>
                        <td>{{ $item->Nombre }}</td>
                        <td>{{ $item->FechaNacimiento }}</td>
                        <td>{{ $item->Direccion }}</td>
                        <td>{{ $item->Celular }}</td>
                        <td>{{ $item->Correo }}</td>
                        <td>
                            @if (in_array(150, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" onclick="changeState('{{$item->Documento}}')"
                                        id="flexSwitchCheckChecked" {{ $checkstate }}>
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>

                {{-- Mensajes personalizados --}}
                @if (isset($sweet_setAll))
                <script>
                    setTimeout(() => {
                        swal_setAll("{{ $sweet_setAll['title'] }}", "{{ $sweet_setAll['msg'] }}",
                            "{{ $sweet_setAll['type'] }}");
                    }, 500);
                </script>
            @endif

    </div>
@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/Programacion/deportista.js') }} "></script>

@endpush
