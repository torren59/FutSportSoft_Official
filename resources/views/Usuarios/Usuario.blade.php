@extends('../layouts/home')



@section('title', 'Usuario')

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
                <h1> Gestión de Usuarios</h1>
            </div>
        </center>
        <br>
        <div class="addbtn">
            <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('usuarioadicion')">Crear <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>
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
                        <td><a href="{{ url('usuario/editar/' . $item->Documento) }}"><button
                                    class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></button></a>
                                    <abbr title="Detalles"><a href="{{ url('usuario/detalle/' . $item->RolId) }}"><button
                                        class="btn btn-outline-secondary"><i
                                            class="fa-solid fa-circle-info"></i></button></a></abbr></td>

                        <td>{{ $item->Documento }}</td>

                        <td> {{ $item->Nombre }} </td>
                        <td> {{ $item->name }} </td>





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
                            <input type="text" class="form-control" name="Documento" value="{{ old('Documento') }}">
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
                            <input type="text" class="form-control" name="Celular" value=" {{ old('Celular') }} ">
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
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" name="password" value=" {{ old('password') }} ">
                            @error('password')
                                <div>
                                    @foreach ($errors->get('password') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="text" class="form-control" name="email" value=" {{ old('email') }} ">
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
                                value=" {{ old('FechaNacimiento') }} ">
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
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Selecione un rol</option>
                                @foreach ($listado['ListadoRoles'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>



                    </div>
                    <br>
                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="switchadicion2('usuarioadicion')">Cancelar</i></button>

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

    </div>
@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush
