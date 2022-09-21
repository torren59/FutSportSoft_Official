@extends('../layouts/home')



@section('title', 'Sedes')

@push('styles')
<link rel="stylesheet" href=" {{asset('./css/layouts/datatable.css')}} ">
<link rel="stylesheet" href="{{asset('./css/layouts/cruds.css')}} ">
<link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
{{-- Listado --}}

<div class="service_list">
    <center>
    <div class="tituloTabla">
            <h1>SEDES</h1>
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
            <tr>
                <td><button class="btn btn-primary" onclick="activaedicion('listadorol','edicionrol')"><i class="fa-solid fa-pen"></i></button></td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                </td>
                <td>Entrenador</td>
                <td>Adiciòn de roles</td>
            </tr>
            <tr>
                <td><button class="btn btn-primary" onclick="activaedicion('listadorol','edicionrol')"><i class="fa-solid fa-pen"></i></button></td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                </td>
                <td>Director tecnico</td>
                <td>Ediciòn de usuarios</td>

            </tr>
        </tbody>
    </table>

    <div class="addbtn">
        <button class="btn btn-success col-3" onclick="switchadicion2('sedeadicion')">Nueva Sede <i class="fa-solid fa-circle-plus"></i></button>
    </div>

    {{-- Creacion de sedes --}}

    <div id="sedeadicion" class="adicion_off" style="width:600px;height:400px">
        <div class="floatcontent">
            <h4 style="padding-top:5%;" >Nueva Sede</h4> <hr>

            <form action={{ url('sede/crear') }} method="post"> @csrf

                <label for="NombreSede" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="NombreSede" value="{{ old('NombreSede') }}">
                @error('NombreSede')
                    <div>
                        @foreach ($errors->get('NombreSede') as $item)
                        <small> {{$item}} </small>
                        @endforeach
                    </div>
                @enderror

                <div class="row">
                    <div class="col-6">
                        <label for="Municipio" class="form-label">Municipio</label>
                        <input type="text" class="form-control" name="Municipio" value=" {{old('Municipio')}} " >
                        @error('Municipio')
                        <div>
                            @foreach ($errors->get('Municipio') as $item)
                            <small> {{$item}} </small>
                            @endforeach
                        </div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="Barrio" class="form-label">Barrio</label>
                        <input type="text" class="form-control" name="Barrio" value=" {{old('Barrio')}} " >
                        @error('Barrio')
                            <div>
                                @foreach ($errors->get('Barrio') as $item)
                                    <small> {{$item}} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
                </div>

                <label for="Direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="Direccion" value=" {{old('Direccion')}} ">
                @error('Direccion')
                    <div>
                        @foreach ($errors->get('Direccion') as $item)
                            <small> {{$item}} </small>
                        @endforeach
                    </div>
                @enderror
                <br>
                <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                <button type="button" class="btn btn-primary btn-danger" onclick="switchadicion2('sedeadicion')">Cancelar</i></button>

            </form>
        </div>
    </div>

    @if ($errors->any())
    <script>
        setTimeout(() => {
            switchadicion2('sedeadicion');
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