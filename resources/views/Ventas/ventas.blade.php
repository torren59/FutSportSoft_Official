@extends('../layouts/home')



@section('title', 'Ventas')

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
                <h1>VENTAS</h1>
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
                    <td><button class="btn btn-primary" onclick="activaedicion('listadorol','edicionrol')"><i
                                class="fa-solid fa-pen"></i></button></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                checked>
                        </div>
                    </td>
                    <td>Entrenador</td>
                    <td>Adiciòn de roles</td>
                </tr>
                <tr>
                    <td><button class="btn btn-primary" onclick="activaedicion('listadorol','edicionrol')"><i
                                class="fa-solid fa-pen"></i></button></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                checked>
                        </div>
                    </td>
                    <td>Director tecnico</td>
                    <td>Ediciòn de usuarios</td>

                </tr>
            </tbody>
        </table>



        <a href=" {{ url('venta/crear') }} ">
            <div class="addbtn">
                <button class="btn btn-success col-3" onclick="switchadicion2('sedeadicion')">Nueva Venta <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        </a>


        {{-- Formulario Temporal, no utilizar --}}

        <div>
            <div class="form-check">
                <input class="form-check-input watchcheck" type="checkbox" value="1" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Selecciona
                </label>
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
@endpush
