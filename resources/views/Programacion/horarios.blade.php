@extends('../layouts/home')



@section('title', 'Horarios')

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
            <h1>HORARIOS</h1>
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
        <button class="btn btn-success col-3" onclick="switchadicion2('horarioadicion')">Nuevo Horario <i class="fa-solid fa-circle-plus"></i></button>
    </div>



    {{-- Creacion de sedes --}}

    <div id="horarioadicion" class="adicion_off" style="width:500px;height:300px">
        <div class="floatcontent">
            <h4 style="padding-top:5%;" >Nuevo Horario</h4> <hr>

            <form action={{ url('horario/crear') }} method="post"> @csrf

                <label for="NombreHorario" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="NombreHorario" value="{{ old('NombreHorario') }}">
                @error('NombreHorario')
                    <div>
                        @foreach ($errors->get('NombreHorario') as $item)
                        <small> {{$item}} </small>
                        @endforeach
                    </div>
                @enderror

                <label for="Horario" class="form-label">Horario</label>
                <input type="text" class="form-control" name="Horario" value=" {{old('Horario')}} ">
                @error('Horario')
                    <div>
                        @foreach ($errors->get('Horario') as $item)
                            <small> {{$item}} </small>
                        @endforeach
                    </div>
                @enderror
                <br>
                <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                <button type="button" class="btn btn-primary btn-danger" onclick="switchadicion2('horarioadicion')">Cancelar</i></button>

            </form>
        </div>
    </div>

    @if ($errors->any())
    <script>
        setTimeout(() => {
            switchadicion2('horarioadicion');
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