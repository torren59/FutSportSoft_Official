@extends('../layouts/home')

@section('title', 'Grupos')

@push('styles')
 {{-- Csrf para funcionamiento de Ajax --}}
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')




    <div class="service_list">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de Grupos</h1>
            </div>
        </center>
        <br>

        @if (in_array(128, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('grupoadicion')">Crear <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>GrupoId</td>
                    <td>Grupo</td>
                    <td>Categoría</td>
                    <td>Entrenador</td>

                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado['ListadoGrupos'] as $item)
                    <tr>
                        <td>
                            @if (in_array(140, $permisos))
                            <abbr title="Editar"><a href="{{ url('grupos/editar/' . $item->GrupoId) }}"><button
                                class="btn btn-outline-primary"><i
                                    class="fa-solid fa-pen"></i></button></a></abbr>
                            @endif


                            @if (in_array(117, $permisos))
                                <abbr title="Detalles"><button type="button" class="btn btn-outline-secondary"
                                        onclick="DetalleGrupos({{ $item->GrupoId }},'detallegrupo','jsPrint')"><i
                                            class="fa-solid fa-circle-info"></i></button></abbr>
                            @endif
                        </td>

                        <td>{{ $item->GrupoId }}</td>
                        <td>{{ $item->NombreGrupo }}</td>
                        <td>{{ $item->NombreCategoria }}</td>
                        <td>{{ $item->Nombre }}</td>


                        <td>
                            @if (in_array(152, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch"
        id="flexSwitchCheckChecked" {{ $checkstate }}
        onclick="changeState2({{ $item->GrupoId }})">
</div>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>


        {{-- Creacion de grupos --}}

        <div id="grupoadicion" class="adicion_off" style="width:600px;height:700px">
            <div class="floatcontent">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="cardgrupos p-2 col-12 text-center">
                            <h1>Nuevo grupo</h1>
                            <form action={{ url('grupos/crear') }} method="post"> @csrf
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <label for="NombreGrupo" class="form-label">Nombre del Grupo</label>
                                        <input type="text" class="form-control" name="NombreGrupo"
                                            value="{{ old('NombreGrupo') }}">
                                        @error('NombreGrupo')
                                            <div>
                                                @foreach ($errors->get('NombreGrupo') as $NombreError)
                                                    <small> {{ $NombreError }} </small>
                                                @endforeach
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="col-6">
                                        <label for="CategoriaId" class="form-label">Categorias</label>
                                        <select class="form-select" name="CategoriaId" aria-label="Default select example">
                                            <option selected>Selecione una categoria</option>
                                            @foreach ($listado['ListadoCategoria'] as $item)
                                                <option value="{{ $item->CategoriaId }}">{{ $item->NombreCategoria }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('CategoriaId')
                                        <div>
                                            @foreach ($errors->get('CategoriaId') as $NombreError)
                                                <small> {{ $NombreError }} </small>
                                            @endforeach
                                        </div>
                                    @enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="Documento" class="form-label">Usuarios</label>
                                        <select class="form-select" name="Documento" aria-label="Default select example">
                                            <option selected>Selecione un Usuario</option>
                                            @foreach ($listado['ListadoUsuario'] as $item)
                                                <option value="{{ $item->Documento }}">{{ $item->Nombre }}  {{$item->Documento}}</option>
                                            @endforeach
                                        </select>
                                        @error('Documento')
                                        <div>
                                            @foreach ($errors->get('Documento') as $NombreError)
                                                <small> {{ $NombreError }} </small>
                                            @endforeach
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <h1>Listado de Deportistas</h1>
                                <div class="grid_doble_superderechagrupos p-4">
                                    <div class="grid_span_1">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td>Selecciona</td>
                                                    <td>Nombre</td>
                                                    <td>Fecha de nacimiento</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($deportistas_crear as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="lista_deportistas">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="deportistas[]" value="{{ $item->Documento }}">
                                                        </td>
                                                        <td>
                                                            <label class="form-check-label"
                                                                for="{{ $item->Documento }}">{{ $item->Nombre }}
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="form-check-label"
                                                                for="{{ $item->Documento }}">{{ $item->FechaNacimiento }}
                                                            </label>
                                                        </td>




                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <div class="botonesroles p-5">
                                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="switchadicion2('grupoadicion')">Cancelar</i></button>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>








    </div>


    {{-- Detalles --}}

    <div id="detallegrupo" class="adicion_off" style="width:600px;height:400px">
        <div class="floatcontent">

            <h1 style="padding-top:5%;">Detalles del Grupo</h1>
            <div id="jsPrint">
                {{-- Aquí se imprime el contenido de detalles enviado desde JS --}}
            </div>
            <div class="boton detalle p-5">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="switchadicion2('detallegrupo')">Cerrar</i></button>
            </div>

        </div>
    </div>

 {{-- Mensajes personalizados --}}
 @if (isset($sweet_setAll))
 <script>
     setTimeout(() => {
         swal_setAll("{{ $sweet_setAll['title'] }}", "{{ $sweet_setAll['msg'] }}",
             "{{ $sweet_setAll['type'] }}");
     }, 500);
 </script>
@endif

@endsection


@if ($errors->any())
        <script>
            setTimeout(() => {
                switchadicion2('grupoadicion');
            }, 500);
        </script>
    @endif




@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>


    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
    <script src=" {{ asset('./js/Programacion/grupos.js') }} "></script>
@endpush
