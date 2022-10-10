@extends('../layouts/home')

@section('title', 'Roles')

@push('styles')
<link rel="stylesheet" href=" {{asset('./css/layouts/datatable.css')}} ">
<link rel="stylesheet" href="{{asset('./css/layouts/cruds.css')}} ">
<link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
@endpush

@section('content')




<div class="service_list" id="listadorol">
    <center>
    <div class="tituloTabla">
            <h1>ROLES</h1>
        </div>
    </center>
    <table id="tabla">
        <thead>
            <tr>
                <td>Acción</td>
                <td>Estado</td>
                <td>Nombre</td>
                <td>Permiso</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($listado as $item)
            <tr>
                <td><a href="{{ url('roles/editar/'.$item->RolId) }}"><button class="btn btn-primary"><i
                                class="fa-solid fa-pen"></i></button></a></td>
                <td>{{ $item->RolId }}</td>
                <td>{{ $item->NombreRol }}</td>
                <td>{{ $item->Estado }}</td>


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
    <button class="btn btn-success col-3" onclick="switchadicion('roladicion')">Nuevo Rol <i class="fa-solid fa-circle-plus"></i></button>
    </div>



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

            <table class="table">
                <thead class="thead-dark">
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Descripciòn</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Visualizaciòn de deportistas</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Visualizaciòn por grupos</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Adiciòn de deportistas</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Ediciòn de deportistas</label>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="mb-3 col-7">
            <button type="submit" class="btn btn-primary btn-success" >Guardar</i></button>
            <button type="button" class="btn btn-primary btn-danger" onclick="switchadicion('roladicion')">Cancelar</i></button>
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

<script src=" {{asset('./js/layouts/cruds.js')}} "></script>

@endpush







