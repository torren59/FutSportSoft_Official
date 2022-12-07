@extends('../layouts/home')



@section('title', 'Editar Categoría')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($data['categorias'] as $item)
        <form action={{ url('categoria/actualizar/' . $item->CategoriaId) }} method="post"> @csrf
    @endforeach
    <div class="container p-5 text-center">
        <div class="row justify-content-center">
            <div class="card col-6">
                <div class="titulo text-center">
                    <h1>Editar Categoría</h1>
                </div>

                @foreach ($data['categorias'] as $item)
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <label for="NombreCategoria" class="form-label">Nombre de Categoría</label>
                            <input type="text" class="form-control" name="NombreCategoria"
                            @if ($errors->any())
                            value = "{{old('NombreCategoria')}}"
                            @else
                            value= "{{$item->NombreCategoria}}"
                            @endif>

                            @error('NombreCategoria')
                                <div>
                                    @foreach ($errors->get('NombreCategoria') as $NombreError)
                                        <small> {{ $NombreError }} </small>
                                    @endforeach

                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="DeporteId" class="form-label">Deportes</label>
                            <select class="form-select" name="DeporteId" aria-label="Default select example">
                                <option selected value="{{ $item->DeporteId }}">{{ $item->NombreDeporte }}</option>
                                 @foreach ($data['deportes'] as $item2)
                                    <option value="{{ $item2->DeporteId }}">{{ $item2->NombreDeporte }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="RangoEdad" class="form-label">Rango de Edad</label>
                            <input type="text" class="form-control" name="RangoEdad"
                            @if ($errors->any())
                            value = "{{old('RangoEdad')}}"
                            @else
                            value="{{$item->RangoEdad}}"
                            @endif>
                            @error('RangoEdad')
                                <div>
                                    @foreach ($errors->get('RangoEdad') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>
                @endforeach


                <div class="botonesusuarios p-5 text-center">
                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                    <a href=" {{ url('categoria/listar') }} "><button type="button"
                            class="btn btn-outline-secondary">Cancelar</i></button></a>
                </div>

                </form>

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
