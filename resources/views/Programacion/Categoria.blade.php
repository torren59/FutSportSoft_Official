@extends('../layouts/home')



@section('title', 'Categorias')

@push('styles')
    {{-- Csrf para funcionamiento de Ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    {{-- Listado --}}

    <div class="service_list">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de Categorías</h1>
            </div>
        </center>

        @if (in_array(127, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('categoriaadicion')">Crear <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Id</td>
                    <td>Categoría</td>
                    <td>Deporte</td>
                    <td>Rango Edad</td>
                    <td>Estado</td>

                </tr>
            </thead>
            <tbody>
                @foreach ($listado['ListadoCategoria'] as $item)
                    <tr>
                        <td>
                            @if (in_array(139, $permisos))
                                <a href="{{ url('categoria/editar/' . $item->CategoriaId) }}"><button
                                        class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></button></a>
                            @endif
                        </td>
                        <td>{{ $item->CategoriaId }}</td>
                        <td> {{ $item->NombreCategoria }} </td>
                        <td> {{ $item->NombreDeporte }} </td>
                        <td> {{ $item->RangoEdad }} </td>

                        <td>
                            @if (in_array(151, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="check_{{ $item->CategoriaId }}" {{ $checkstate }}
                                        onclick="tryChange('{{ $item->CategoriaId }}', 'errorsEstado')">
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>



        {{-- Creacion de categorias --}}

        <div id="categoriaadicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h1 style="padding-top:5%;">Crear Categoría</h1>


                <form action={{ url('categoria/crear') }} method="post"> @csrf
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <label for="NombreCategoria" class="form-label">Categoría</label>
                            <input type="text" class="form-control" name="NombreCategoria"
                                value="{{ old('NombreCategoria') }}">
                            @error('NombreCategoria')
                                <div>
                                    @foreach ($errors->get('NombreCategoria') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="deportes" class="form-label">Deportes</label>
                            <select class="form-select" name="DeporteId" aria-label="Default select example">
                                <option selected>Selecione un Deporte</option>
                                @foreach ($listado['ListadoDeporte'] as $item)
                                    <option value="{{ $item->DeporteId }}">{{ $item->NombreDeporte }}</option>
                                @endforeach
                            </select>
                            @error('DeporteId')
                            <div>
                                @foreach ($errors->get('DeporteId') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                        </div>
                        <div class="col-6">
                            <label for="RangoEdad" class="form-label">Rango de Edad</label>
                            <input type="text" class="form-control" name="RangoEdad" value=" {{ old('RangoEdad') }} ">
                            @error('RangoEdad')
                                <div>
                                    @foreach ($errors->get('RangoEdad') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="botonescategoria p-5">
                        <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="switchadicion2('categoriaadicion')">Cancelar</i></button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Alerta cambio de estado --}}
        <div class="adicion_off" id="errorsEstado" style="width:550px">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Operación cancelada</h4>
                <div>
                    No fue posible realizar el cambio de estado. <br>
                    Esta categoria está vinculada a grupos activos.
                </div>
                <div id="errorsEstadoMsg">
                    {{-- Acá se imprimen las programaciones vinculadas --}}
                </div>
                <br>
                <button type="button" class="btn btn-primary btn-danger"
                    onclick="alterModal('errorsEstado')">Cancelar</i></button> <br>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('categoriaadicion');
                }, 500);
            </script>
        @endif

         {{-- Mensajes personalizados --}}
         @if (isset($sweet_setAll))
         <script>
             setTimeout(() => {
                 swal_setAll("{{ $sweet_setAll['title'] }}", "{{ $sweet_setAll['msg'] }}",
                     "{{ $sweet_setAll['type'] }}");
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

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/Programacion/categorias.js') }} "></script>

@endpush
