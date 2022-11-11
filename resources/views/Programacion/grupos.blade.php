@extends('../layouts/home')

@section('title', 'Grupos')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">

@endpush

@section('content')




    <div class="service_list" id="listadocompra">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de Grupos</h1>
            </div>
        </center>
        <br>


        <div class="botoncompras"><button class="btn btn-outline-secondary col-2"
                onclick="switchadicion2('selectproveedor')">Crear <i class="fa-solid fa-circle-plus"></i></button></div>

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>GrupoId</td>
                    <td>Categoría</td>
                    <td>Documento Entrenador</td>
                    <td>Nombre del grupo</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado['ListadoGrupos'] as $item)
                    <tr>
                        <td><abbr title="Detalles"><button type="button" class="btn btn-outline-secondary"
                                    onclick="detalleGrupo({{ $item->GrupoId }},'detallegrupo','jsPrint')"><i
                                        class="fa-solid fa-circle-info"></i></button></abbr>
                        </td>
                        <td>{{ $item->GrupoId }}</td>
                        <td>{{ $item->CategoriaId }}</td>
                        <td>{{ $item->Documento }}</td>
                        <td>{{ $item->NombreGrupo }}</td>


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


    </div>
    </div>

    {{-- Detalles --}}

    <div id="detallecompra" class="adicion_off" style="width:600px;height:400px">
        <div class="floatcontent">

            <h1 style="padding-top:5%;">Detalles del Grupo</h1>
            <div id="jsPrint">
                {{-- Aquí se imprime el contenido de detalles enviado desde JS --}}
            </div>
            <div class="boton detalle p-5">
            <button type="button" class="btn btn-outline-secondary"
                onclick="switchadicion2('detallegrupo')">Cerrar</i></button></div>

        </div>
    </div>


@endsection





@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>


    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
@endpush
