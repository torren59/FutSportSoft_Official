@extends('../layouts/home')



@section('title', 'Usuario')

@push('styles')
{{-- Csrf para funcionamiento de Ajax --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    {{-- Listado --}}

    <div class="service_list">
        <center>
            <div class="tituloTabla">
                <h1> Gestión de Usuarios</h1>
            </div>
        </center>
        <br>

        @if (in_array(120, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('usuarioadicion')">Crear <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Documento</td>
                    <td>Nombre</td>
                    <td>Rol</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado['ListadoUsuario'] as $item)
                    <tr>
                        <td>

                            @if (in_array(133, $permisos))
                                <a href="{{ url('usuario/editar/' . $item->id) }}">
                                    <button class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i>
                                    </button>
                                </a>
                            @endif

                            @if (in_array(115, $permisos))
                                <abbr title="Detalles">
                                    <button type="button"
                                        class="btn btn-outline-secondary"onclick="detalleUsuario({{ $item->id }},'detalleusuario','jsPrint')">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </button>
                                </abbr>
                            @endif

                            @if (in_array(142, $permisos))
                                <abbr title="Cambiar clave">
                                    <a href="{{ url('usuario/newpassword/' . $item->id) }}">
                                        <button class="btn btn-outline-success"><i class="fa-solid fa-lock"></i></button>
                                    </a>
                                </abbr>
                            @endif
                        </td>
                        <td>{{ $item->Documento }}</td>
                        <td> {{ $item->Nombre }} </td>
                        <td> {{ $item->name }} </td>





                        <td>
                            @if (in_array(144, $permisos))
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



        {{-- Creacion de Usuarios --}}

        <div id="usuarioadicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h1 style="padding-top:5%;">Nuevo Usuario</h1>
                <hr>
                <form action={{ url('usuario/crear') }} method="post"> @csrf

                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="Nombre" value=" {{ old('Nombre') }} ">
                    @error('Nombre')
                        <div>
                            @foreach ($errors->get('Nombre') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror


                    <div class="row">
                        <div class="col-6">
                            <label for="Documento" class="form-label">Documento</label>
                            <input type="number" class="form-control" name="Documento" value="{{ old('Documento') }}">
                            @error('Documento')
                                <div>
                                    @foreach ($errors->get('Documento') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="Celular" class="form-label">Celular</label>
                            <input type="number" class="form-control" name="Celular" value=" {{ old('Celular') }} ">
                            @error('Celular')
                                <div>
                                    @foreach ($errors->get('Celular') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="Direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="Direccion" value=" {{ old('Direccion') }} ">
                            @error('Direccion')
                                <div>
                                    @foreach ($errors->get('Direccion') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="email" value=" {{ old('email') }} ">
                            @error('email')
                                <div>
                                    @foreach ($errors->get('email') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="FechaNacimiento" class="form-label">FechaNacimiento</label>
                            <input type="date" class="form-control" name="FechaNacimiento"
                                value="{{ old('FechaNacimiento') }}">
                            @error('FechaNacimiento')
                                <div>
                                    @foreach ($errors->get('FechaNacimiento') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                        <div class="col-6">
                            <label for="roles" class="form-label">Roles</label>
                            <select class="form-select" name="RolId" aria-label="Default select example">
                                <option selected>Selecione un rol</option>
                                @foreach ($listado['ListadoRoles'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('RolId')
                                <div>
                                    @foreach ($errors->get('RolId') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" name="password" value="{{ old('password') }}">
                            @error('password')
                                <div>
                                    @foreach ($errors->get('password') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                    </div>
                    <div class="botonesusuarios p-5">
                        <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="switchadicion2('usuarioadicion')">Cancelar</i></button>
                    </div>

                </form>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('usuarioadicion');
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

    {{-- Detalles --}}

    <div id="detalleusuario" class="adicion_off" style="width:600px;height:400px">
        <div class="floatcontent">

            <h1 style="padding-top:5%;">Detalles del usuario</h1>
            <div id="jsPrint">
                {{-- Aquí se imprime el contenido de detalles enviado desde JS --}}
            </div>
            <div class="boton detalle p-5">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="switchadicion2('detalleusuario')">Cerrar</i></button>
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
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
    <script src=" {{ asset('./js/layouts/Usuario/Usuario.js') }} "></script>
@endpush
