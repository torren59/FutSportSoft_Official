@extends('../layouts/home')



@section('title', 'Detalle Deportista')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <div class="floatmodal" style="width: 50%;">
        @foreach ($listadoDeportista as $item)
            <div class="floatcontent" style="height: 70vh">
                <div class="col-12" style="display:flex;justify-content:flex-start;position:fixed;top:6%;">
                    <a href=" {{ url('deportista/listar') }} ">
                        <button class="btn btn-outline-danger">
                            <i class="fa-sharp fa-solid fa-arrow-left"></i> Salir
                        </button>
                    </a>
                </div>

                <h1>Detalles del deportista</h1>

                <div class="col-12">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input readonly type="text" class="form-control" name="Nombre" value="{{ $item->Nombre }}">

                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="Documento" class="form-label">Documento</label>
                        <input readonly type="text" class="form-control" name="Documento" value="{{ $item->Documento }}">
                    </div>

                    <div class="col-6">
                        <label for="Descripcion" class="form-label">Tipo de documento</label>
                        <input readonly type="text" class="form-control" name="Descripcion"
                            value="{{ $item->Descripcion }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="Correo" class="form-label">Correo</label>
                        <input readonly type="text" class="form-control" name="Correo" value="{{ $item->Correo }}">
                    </div>

                    <div class="col-6">
                        <label for="Celular" class="form-label">Celular</label>
                        <input readonly type="text" class="form-control" name="Celular" value="{{ $item->Celular }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="FechaNacimiento" class="form-label">Fecha de nacimiento</label>
                        <input readonly type="date" class="form-control" name="FechaNacimiento"
                            value="{{ $item->FechaNacimiento }}">
                    </div>

                    <div class="col-4">
                        <label for="Direccion" class="form-label">Direccion</label>
                        <input readonly type="text" class="form-control" name="Nombre" value="{{ $item->Direccion }}">
                    </div>

                    <div class="col-4">
                        <label for="DocumentoAcudiente" class="form-label">Documento del acudiente</label>
                        <input type="text" class="form-control" name="DocumentoAcudiente"
                            value="{{ $item->DocumentoAcudiente }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="NombreAcudiente" class="form-label">Acudiente</label>
                        <input readonly type="text" class="form-control" name="Nombre"
                            value="{{ $item->NombreAcudiente }}">
                    </div>

                    <div class="col-4">
                        <label for="CorreoAcudiente" class="form-label">Correo del acudiente</label>
                        <input readonly type="text" class="form-control" name="CorreoAcudiente"
                            value="{{ $item->CorreoAcudiente }}">
                    </div>

                    <div class="col-4">
                        <label for="CelularAcudiente" class="form-label">Contacto acudiente</label>
                        <input readonly type="text" class="form-control" name="CelularAcudiente"
                            value="{{ $item->CelularAcudiente }}">
                    </div>
                </div>
                <br>
                <br>

            </div>
        @endforeach

    </div>
@endsection

@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush
