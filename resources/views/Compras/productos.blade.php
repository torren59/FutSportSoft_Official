@extends('../layouts/home')



@section('title', 'Productos')

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
                <h1>PRODUCTOS</h1>
            </div>
            </center>
    <table id="tabla" >
        <thead>
            <tr>
                <td>Acción</td>
                <td>IDProducto</td>
                <td>Tipo</td>
                <td>Nombre</td>
                <td>Cantidad</td>
                <td>Talla</td>
                <td>Precio</td>
            </tr>
        </thead>
        <tbody>
        <tr>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                </td>
            <td>CASMAN55</td>
            <td>U</td>
            <td>Camisa manchester</td>
            <td>23</td>
            <td>XL</td>
            <td>$ 33.000</td>
        </tr>
        <tr>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
            </td>
            <td>PANTMAN55</td>
            <td>U</td>
            <td>Pantaloneta manchester</td>
            <td>25</td>
            <td>M</td>
            <td>$ 23.000</td>
        </tr>
        <tr>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
            </td>
            <td>MEDMAN55</td>
            <td>U</td>
            <td>Medias manchester</td>
            <td>20</td>
            <td>10 - 12</td>
            <td>$ 8.000</td>
        </tr>
        </tbody>
    </table>
    <div class="addbtn">
    <button class="btn btn-success col-4" onclick="switchadicion('sedeadicion')">Crear articulo <i class="fa-solid fa-circle-plus"></i></button>
        </div>
        <div class="adicion adicion_off" id="sedeadicion">
        <div class="adicion_title">
            <h1>Crear Articulo</h1>
        </div>
        <div class="adicion_content" id="addsed">

            <div class="mb-3  col-7">
                <label for="exampleInputEmail1" class="form-label">IDProducto</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Tipo</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Talla</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Precio</label>
                <input type="email" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-7">
                <button type="button" class="btn btn-primary btn-success" onclick="swal_savecreation(), switchadicion('sedeadicion')">Guardar</i></button>
                <button type="button" class="btn btn-primary btn-danger" onclick="switchadicion('sedeadicion')">Cancelar</i></button>
            </div>
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