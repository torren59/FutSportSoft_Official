@extends('../layouts/home')



@section('title', 'Deportes')

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
            <h1>DEPORTES</h1>
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
    <button class="btn btn-success col-3" onclick="switchadicion('roladicion')">Nuevo Deporte <i class="fa-solid fa-circle-plus"></i></button>
    </div>

    AQUI

    @if ($errors->any())

    @foreach ($errors->get('NombreDeporte') as $item)
    
    {{$item}}

    @endforeach
        
    @endif

    <div class="float_window">
        H
    </div>

    {{-- Creacion de deportes --}}
    <div class="adicion adicion_off" id="roladicion">
        <form action={{ url('deporte/crear') }} method="post">
            
            @csrf
            <div class="adicion_title">
                <h1>Nuevo Deporte</h1>
            </div>

        
            <div class="adicion_content" id="addsed">

                <div class="mb-3  col-5">
                    <label class="form-label">Nombre Deporte</label>
                    <input type="text" class="form-control" name="NombreDeporte">
                </div>
               
            </div>
            <div class="mb-3 col-7">
                <button type="submit" class="btn btn-primary btn-success" onclick="swal_savecreation(), switchadicion('roladicion')">Guardar</i></button>
                <button type="button" class="btn btn-primary btn-danger" onclick="switchadicion('roladicion')">Cancelar</i></button>
            </div>

        </form>
    </div>

</div>





@endsection

@push('scripts')

<script>
    let tabla = document.getElementById("tabla");
    let datatable = new DataTable(tabla);
</script>

<script src=" {{asset('./js/layouts/cruds.js')}} "></script>

@endpush