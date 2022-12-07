@extends('../layouts/home')



@section('title', 'Editar sede')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($sededata as $item)
        <form action={{ url('sede/actualizar/' . $item->SedeId) }} method="post">
    @endforeach

    @csrf
    <div class="grid_triple_center">
        <div class="grid_span_2a3">
            <div class="container text-center">
                <div class="row justify-content-center p-5">
                    <div class="card col-6">

                        <h1>Editar Sede</h1>


                        @foreach ($sededata as $item)
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <label for="NombreSede" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="NombreSede"
                                @if ($errors->any())
                                value = "{{old('NombreSede')}}"
                                @else
                                value="{{$item->NombreSede}}"
                                @endif>
                                @error('NombreSede')
                                    <div>
                                        @foreach ($errors->get('NombreSede') as $item)
                                            <small> {{ $item }} </small>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>

                                <div class="col-6">
                                    <label for="Municipio" class="form-label">Municipio</label>
                                    <input type="text" class="form-control" name="Municipio"
                                    @if ($errors->any())
                                    value = "{{old('Municipio')}}"
                                    @else
                                    value="{{$item->Municipio}}"
                                    @endif>
                                    @error('Municipio')
                                        <div>
                                            @foreach ($errors->get('Municipio') as $item)
                                                <small> {{ $item }} </small>
                                            @endforeach
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="Barrio" class="form-label">Barrio</label>
                                    <input type="text" class="form-control" name="Barrio"
                                    @if ($errors->any())
                                    value = "{{old('Barrio')}}"
                                    @else
                                    value="{{$item->Barrio}}"
                                    @endif>
                                    @error('Barrio')
                                        <div>
                                            @foreach ($errors->get('Barrio') as $item)
                                                <small> {{ $item }} </small>
                                            @endforeach
                                        </div>
                                    @enderror
                                </div>

                            <div class="col-6">
                                <label for="Direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" name="Direccion"
                                @if ($errors->any())
                                value = "{{old('Direccion')}}"
                                @else
                                value="{{$item->Direccion}}"
                                @endif>
                                @error('Direccion')
                                    <div>
                                        @foreach ($errors->get('Direccion') as $item)
                                            <small> {{ $item }} </small>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                        <div class="botonessedes p-5">
                            <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                            <a href=" {{ url('sede/listar') }} "><button type="button"
                                    class="btn btn-outline-secondary">Cancelar</i></button></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </form>
@endsection

@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush
