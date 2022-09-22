@extends('../layouts/home')



@section('title', 'Deportistas')

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
                <h1>DEPORTISTAS</h1>
            </div>
    </center>
    <table id="tabla">
        <thead>
            <tr>
                <td>Acción</td>
                <td>Estado</td>
                <td>Documento</td>
                <td>Nombre</td>
                <td>Deporte</td>
                <td>Servicio deportivo</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <button class="btn btn-primary" title="Editar" onclick="activaedicion('listadosede','edicionsede')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-secondary" title="Informacion" onclick="switchadicion('servdepdetalle')"><i class="fa-solid fa-circle-info"></i></button>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                </td>
                <td>10043566</td>
                <td>Julián Álvarez Nuñez</td>
                <td>Natación</td>
                <td>Dolphins</td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary" title="Editar" onclick="activaedicion('listadosede','edicionsede')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-secondary" title="Informacion" onclick="switchadicion('servdepdetalle')"><i class="fa-solid fa-circle-info"></i></button>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                </td>
                <td>5567894</td>
                <td>Manuel Elkin Patarroyo</td>
                <td>Volleyball</td>
                <td>Sand Champions</td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary" title="Editar" onclick="activaedicion('listadosede','edicionsede')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-secondary" title="Informacion" onclick="switchadicion('servdepdetalle')"><i class="fa-solid fa-circle-info"></i></button>
                </td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    </div>
                </td>
                <td>43532088</td>
                <td>Jorge Luiz Sandoval</td>
                <td>Fútbol</td>
                <td>Leones Sub-17</td>
            </tr>
        </tbody>
    </table>
    <div class="addbtn">
    <button class="btn btn-success col-4" onclick="switchadicion('servdepadicion')">Nuevo deportista <i class="fa-solid fa-circle-plus"></i></button>
    </div>

    <div class="adicion adicion_off" id="servdepadicion">
        <div class="adicion_title">
            <h1>Nuevo deportista</h1>
        </div><br>
        <div class="adicion_content" id="addsed">

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Documento</label>
                <input type="number" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre deportista</label>
                <input type="text" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Celular</label>
                <input type="number" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Dirección</label>
                <input type="text" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Fecha nacimiento</label>
                <input type="date" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre deporte</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>--</option>
                    <option value="1">Fútbol</option>
                    <option value="2">Basketball</option>
                    <option value="3">Volleyball</option>
                    <option value="4">Natación</option>
                </select>
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre categoría</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>--</option>
                    <option value="1">infantil</option>
                    <option value="2">juvenil</option>
                    <option value="3">Entendido</option>
                    <option value="4">Profesional</option>
                </select>
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre servicio deportivo</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>--</option>
                    <option value="1">Leones Sub-17</option>
                    <option value="2">Leones Sub-18</option>
                    <option value="3">Aguilas Sub-15</option>
                    <option value="4">Aguilas Sub-18</option>
                </select>
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Documento acudiente</label>
                <input type="number" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre acudiente</label>
                <input type="text" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Celular acudiente</label>
                <input type="number" class="form-control" aria-describedby="emailHelp">
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Estado de pago</label>
                <div class="col-12" id="estadopago">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            En mora
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Paz y salvo
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-7">
                <button type="button" class="btn btn-primary btn-success" onclick="swal_savecreation(), switchadicion('servdepadicion')">Guardar</i></button>
                <button type="button" class="btn btn-primary btn-danger" onclick="switchadicion('servdepadicion')">Cancelar</i></button>
            </div>
        </div>
    </div>

    <div class="adicion adicion_off" id="servdepdetalle">
        <div class="adicion_title">
            <h1>Detalles deportista</h1>
        </div><br>
        <div class="adicion_content" id="addsed">

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre deportista</label>
                Julián Álvarez Nuñez
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Celular</label>
                3213776566
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Dirección</label>
                Calle 56 #35 - 05
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Fecha nacimiento</label>
                2002-11-18
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre deporte</label>
                Fútbol
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre categoría</label>
                Profesional
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre servicio deportivo</label>
                Águilas
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Documento acudiente</label>
                8443200
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Nombre acudiente</label>
                Juan Andrés López
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Celular acudiente</label>
                3213445577
            </div>

            <div class="mb-3 col-7">
                <label for="exampleInputEmail1" class="form-label">Estado de pago</label>
                <div class="col-12" id="estadopago">
                    <div class="form-check">
                        <input checked class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            En mora
                        </label>
                    </div>
                    <div class="form-check">
                        <input disabled class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Paz y salvo
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-7">
                <button type="button" class="btn btn-primary btn-danger" onclick="switchadicion('servdepdetalle')">Cerrar</i></button>
            </div>

        </div>
    </div>

</div>

<div class="service_edit" id="edicionsede">
    <br>
    <div class="btnCerrar">
        <button type="button" class="btn btn-primary btn-danger" onclick="quitaedicion('listadosede','edicionsede')"><i class="fa-solid fa-circle-xmark"></i></button>
    </div>

    <h2>Editar deportista</h2>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Nombre deportista</label>
        <input type="text" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Celular</label>
        <input type="number" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Dirección</label>
        <input type="text" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Fecha nacimiento</label>
        <input type="date" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Nombre deporte</label>
        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected>--</option>
            <option value="1">Fútbol</option>
            <option value="2">Basketball</option>
            <option value="3">Volleyball</option>
            <option value="4">Natación</option>
        </select>
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Nombre categoría</label>
        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected>--</option>
            <option value="1">infantil</option>
            <option value="2">juvenil</option>
            <option value="3">Entendido</option>
            <option value="4">Profesional</option>
        </select>
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Nombre servicio deportivo</label>
        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected>--</option>
            <option value="1">Leones Sub-17</option>
            <option value="2">Leones Sub-18</option>
            <option value="3">Aguilas Sub-15</option>
            <option value="4">Aguilas Sub-18</option>
        </select>
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Documento acudiente</label>
        <input type="number" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Nombre acudiente</label>
        <input type="text" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Celular acudiente</label>
        <input type="number" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="mb-3 ">
        <label for="exampleInputEmail1" class="form-label">Estado de pago</label>
        <div class="col-12" id="estadopago">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    En mora
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Paz y salvo
                </label>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-primary btn-success" onclick="swal_saveedition(), quitaedicion('listadosede','edicionsede')">Guardar</i></button>
    </div>
    <br>
</div>
@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush