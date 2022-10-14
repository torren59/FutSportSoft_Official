@extends('../layouts/home')

@section('title', 'Roles')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
@endpush

@section('content')




    <div class="service_list" id="listadorol">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de Roles</h1>
            </div>
        </center>
        <br>
        <div class="addbtn">
            <button class="btn btn-outline-secondary col-2" onclick="switchadicion('roladicion')">Crear <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>
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
                        <td><abbr title="Editar"><a href="{{ url('roles/editar/' . $item->RolId) }}"><button
                                        class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></button></a></abbr>

                            <abbr title="Detalles"><a href="{{ url('roles/detalle/' . $item->RolId) }}"><button
                                        class="btn btn-outline-secondary"><i class="fa-solid fa-circle-info"></i></button></a></abbr>
                        </td>
                        <td>{{ $item->RolId }}</td>
                        <td>{{ $item->NombreRol }}</td>

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




        {{-- Creacion de roles --}}
        <div class="adicion adicion_off" id="roladicion">
            <div class="adicion_title">
                <h1>Nuevo Rol</h1>
            </div>
            <div class="adicion_content" id="addsed">

                <form action={{ url('roles/crear') }} method="post"> @csrf

                    <label for="NombreRol" class="form-label">Nombre del Rol</label>
                    <input type="text" class="form-control" name="NombreRol" value="{{ old('NombreRol') }}">
                    @error('NombreRol')
                        <div>
                            @foreach ($errors->get('NombreSede') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                    <div class="adicion_title">
                        <h2>Lista de Permisos</h2>
                    </div>
                    <label>Selecciona los permisos que deseas asignarle al rol</label>
                    <select class="select" multiple>
                        <optgroup label="Label 1">
                          <option value="1" data-mdb-secondary-text="Secondary text">One</option>
                          <option value="2" data-mdb-secondary-text="Secondary text">Two</option>
                          <option value="3" data-mdb-secondary-text="Secondary text">Three</option>
                        </optgroup>
                        <optgroup label="Label 2">
                          <option value="4" data-mdb-secondary-text="Secondary text">Four</option>
                          <option value="5" data-mdb-secondary-text="Secondary text">Five</option>
                          <option value="6" data-mdb-secondary-text="Secondary text">Six</option>
                        </optgroup>
                      </select>



            </div>
            <div class="mb-3 col-7">
                <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                <button type="button" class="btn btn-primary btn-danger"
                    onclick="switchadicion('roladicion')">Cancelar</i></button>
            </div>
        </div>
        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('rolesadicion');
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
