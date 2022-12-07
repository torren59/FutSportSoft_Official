@extends('../layouts/home')

@section('title', 'Roles')

@push('styles')
    {{-- Csrf para funcionamiento de Ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')




    <div class="service_list" id="listadorol">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de Roles</h1>
            </div>
        </center>
        <br>

        @if (in_array(119, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('roladicion')">Crear <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td>

                            @if (in_array(132, $permisos))
                                <abbr title="Editar"><a href="{{ url('roles/editar/' . $item->id) }}"><button
                                            class="btn btn-outline-primary"><i
                                                class="fa-solid fa-pen"></i></button></a></abbr>
                            @endif

                            @if (in_array(114, $permisos))
                                <abbr title="Detalles"><button type="button" class="btn btn-outline-secondary"
                                        onclick="DetalleRoles({{ $item->id }},'detalleroles','jsPrint')"><i
                                            class="fa-solid fa-circle-info"></i></button></abbr>
                            @endif

                        </td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>

                        <td>
                            @if (in_array(143, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" {{ $checkstate }}
                                        onclick="changeState2({{ $item->id }})">
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>




        {{-- Creacion de roles --}}

        <div id="roladicion" class="adicion_off" style="width:800px;height:600px">
            <div class="floatcontent">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="cardRoles p-2 col-12 text-center">
                            <h1>Nuevo Rol</h1>
                            <form action={{ url('roles/crear') }} method="post"> @csrf
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div>
                                                @foreach ($errors->get('name') as $item)
                                                    <small> {{ $item }} </small>
                                                @endforeach
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid_doble_superderecharoles p-4">
                                    <div class="grid_span_1">
                                        <h1>Listado de permisos</h1>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td>Selecciona</td>
                                                    <td>Permiso</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($permisos_crear as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="lista_permisos">
                                                                <input type="checkbox" class="form-check-input productcheck"
                                                                    name="permisos[]" value="{{ $item->PermisoId }}">
                                                        </td>
                                                        <td>
                                                            <label class="form-check-label"
                                                                for="{{ $item->PermisoId }}">{{ $item->NombrePermiso }}
                                                            </label>
                                                        </td>
                                    </div>



                                    </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                        </div>


                        <div class="botonesroles p-5">
                            <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="switchadicion2('roladicion')">Cancelar</i></button>
                        </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

    {{-- Detalles --}}

    <div id="detalleroles" class="adicion_off" style="width:600px;height:400px">
        <div class="floatcontent">

            <h1 style="padding-top:5%;">Detalles del rol</h1>
            <div id="jsPrint">
                {{-- Aquí se imprime el contenido de detalles enviado desde JS --}}
            </div>
            <div class="boton detalle p-5">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="switchadicion2('detalleroles')">Cerrar</i></button>
            </div>

        </div>
    </div>

    @if ($errors->any())
        <script>
            setTimeout(() => {
                switchadicion2('roladicion');
            }, 500);
        </script>
    @endif

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
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
    <script src=" {{ asset('./js/layouts/Configuracion/Roles.js') }} "></script>
@endpush
