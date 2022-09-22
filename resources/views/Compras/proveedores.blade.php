@extends('../layouts/home')



@section('title', 'Proveedores')

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
                <h1>PROVEEDORES</h1>
            </div>
    </center>
    <table id="tabla" >
        <thead>
            <tr>
                <td>Acción</td>
                <td>Estado</td>
                <td>Proveedor</td>
                <td>Nit</td>
                <td>Categoria</td>
                <td>Contacto</td>
                <td>Titular</td>
                <td>Correo</td>
            </tr>
        </thead>
        <tbody>
        <tr><td><button class="btn btn-primary" onclick="activaedicion('listadosproveedores','edicionproveedores')"><i class="fa-solid fa-pen"></i></button>
        </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                </td>
            <td>GOLTY</td>
            <td>8003589563</td>
            <td>1</td>
            <td>305 356 98 75</td>
            <td>Julian alzate</td>
            <td>alzate@gmail.com</td>
        </tr>
        <tr>
        <td><button class="btn btn-primary" onclick="activaedicion('listadosproveedores','edicionproveedores')"><i class="fa-solid fa-pen"></i></button></td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
            </td>
            <td>MOLTEN</td>
            <td>9513862001</td>
            <td>2</td>
            <td>310 569 53 62</td>
            <td>Luis Hernandez</td>
            <td>luis@gmail.com</td>
        </tr>
        <tr>
        <td><button class="btn btn-primary" onclick="activaedicion('listadosproveedores','edicionproveedores')"><i class="fa-solid fa-pen"></i></button></td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
            </td>
            <td>JOMA</td>
            <td>8213862863</td>
            <td>3</td>
            <td>311 588 44 66</td>
            <td>Julio Isaza</td>
            <td>isaza@gmail.com</td>
        </tr>
        </tbody>
    </table>
    <div class="addbtn">
        <button class="btn btn-success col-4" onclick="switchadicion('sedeadicion')">Nuevo Proveedor <i class="fa-solid fa-circle-plus"></i></button>
        </div>
        <div class="adicion adicion_off" id="sedeadicion">
        <div class="adicion_title">
            <h1>Nuevo Proveedor</h1>
        </div>
        <div class="adicion_content" id="addsed">

            <div class="mb-3  col-7">
                <label for="exampleInputEmail1" class="form-label">Proveedor</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nit</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Categoria</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Contacto</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <button type="button" class="btn btn-primary btn-success" onclick="swal_savecreation(), switchadicion('sedeadicion')">Guardar</i></button>
                <button type="button" class="btn btn-primary btn-danger" onclick="switchadicion('sedeadicion')">Cancelar</i></button>
            </div>
        </div>
    </div>

</div>

<div class="service_edit" id="edicionproveedores">
    <br>
    <div class="btnCerrar">
        <button type="button" class="btn btn-primary btn-danger" onclick="quitaedicion('listadosproveedores','edicionproveedores')"><i class="fa-solid fa-circle-xmark"></i></button>
    </div>
    <h2>Editar Proveedor</h2>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Proveedor</label>
        <input type="email" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nit</label>
        <input type="email" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Categoria</label>
        <input type="email" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Contacto</label>
        <input type="email" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Correo</label>
        <input type="email" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-primary btn-success" onclick="swal_saveedition(), quitaedicion('listadosproveedores','edicionproveedores')">Guardar</i></button>
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