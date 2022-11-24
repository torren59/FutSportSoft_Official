@extends('../layouts/home')



@section('title', 'Categorias')

@push('styles')
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
        <div class="addbtn">
            <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('categoriaadicion')">Crear <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>
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
                        <td><a href="{{ url('categoria/editar/' . $item->CategoriaId) }}"><button
                                    class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></button></a></td>
                        <td>{{ $item->CategoriaId }}</td>
                        <td> {{ $item->NombreCategoria }} </td>
                        <td> {{ $item->NombreDeporte }} </td>
                        <td> {{ $item->RangoEdad }} </td>

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



        {{-- Creacion de categorias --}}

        <div id="categoriaadicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h1 style="padding-top:5%;">Crear Categoría</h1>
                <hr>

                <form action={{ url('categoria/crear') }} method="post"> @csrf
                    <div class="row">
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
                        <div class="col-6">
                            <label for="deportes" class="form-label">Deportes</label>
                            <select class="form-select"  name="DeporteId" aria-label="Default select example">
                                <option selected>Selecione un Deporte</option>
                                @foreach ($listado['ListadoDeporte'] as $item)
                                    <option value="{{ $item->DeporteId }}">{{ $item->NombreDeporte }}</option>
                                @endforeach
                            </select>
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


                    <br>
                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="switchadicion2('categoriaadicion')">Cancelar</i></button>

                </form>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('categoriaadicion');
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
@endpush
