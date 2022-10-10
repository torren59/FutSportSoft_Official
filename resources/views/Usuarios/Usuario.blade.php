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
                <h1>USUARIOS</h1>
            </div>
        </center>
        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Documento</td>

                    <td>Nombre</td>
                    <td>Rol</td>

                    <td>Correo</td>

                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td><a href="{{ url('usuario/editar/' . $item->Documento) }}"><button class="btn btn-primary"><i
                                        class="fa-solid fa-pen"></i></button></a></td>
                        <td>{{ $item->Documento }}</td>

                        <td> {{ $item->Nombre }} </td>
                        <td> {{ $item->RolId }} </td>





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

        <div class="addbtn">
            <button class="btn btn-success col-3" onclick="switchadicion2('usuarioadicion')">Nuevo Usuario <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>

        {{-- Creacion de Usuarios --}}

        <div id="usuarioadicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Nuevo Usuario</h4>
                <hr>

                <form action={{ url('usuario/crear') }} method="post"> @csrf

                    <label for="Documento" class="form-label">Documento</label>
                    <input type="text" class="form-control" name="Documento" value="{{ old('Documento') }}">
                    @error('Documento')
                        <div>
                            @foreach ($errors->get('Documento') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <div class="row">
                        <div class="col-6">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="Nombre" value=" {{ old('Nombre') }} ">
                            @error('Nombre')
                                <div>
                                    @foreach ($errors->get('Nombre') as $item)
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
                            <label for="Correo" class="form-label">Correo</label>
                            <input type="text" class="form-control" name="Correo" value=" {{ old('Correo') }} ">
                            @error('Correo')
                                <div>
                                    @foreach ($errors->get('Correo') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Seleciona un Rol</option>
                            @foreach ($listado as $item)
                            <option value="	{{$item->RolId}}">{{$item->NombreRol}}</option>
                            @endforeach
                          </select>
                    </div>

                    <label for="Direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="Direccion" value=" {{ old('Direccion') }} ">
                    @error('Direccion')
                        <div>
                            @foreach ($errors->get('Direccion') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <div class="col-6">
                        <label for="FechaNacimiento" class="form-label">FechaNacimiento</label>
                        <input type="text" class="form-control" name="FechaNacimiento" value=" {{ old('FechaNacimiento') }} ">
                        @error('FechaNacimiento')
                            <div>
                                @foreach ($errors->get('FechaNacimiento') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                            <div class="col-6">
                                <label for="Clave" class="form-label">Clave</label>
                                <input type="text" class="form-control" name="Celular" value=" {{ old('Clave') }} ">
                                @error('Clave')
                                    <div>
                                        @foreach ($errors->get('Clave') as $item)
                                            <small> {{ $item }} </small>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Seleciona un Rol</option>
                                @foreach ($listado as $item)
                                <option value="	{{$item->RolId}}">{{$item->NombreRol}}</option>
                                @endforeach


                              </select>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <button type="button" class="btn btn-primary btn-danger"
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
