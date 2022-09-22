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
        <form action={{ url('sede/actualizar/'.$item->SedeId) }} method="post">
    @endforeach

    @csrf
    <div class="grid_triple_center">
        <div class="grid_span_2a3">
            <div class="adicion_title">
                <h1>Editar Sede</h1>
            </div>

            @foreach ($sededata as $item)
            <div class="col-12">
                <label for="NombreSede" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="NombreSede" value="{{ old('NombreSede',$item->NombreSede) }}">
                @error('NombreSede')
                    <div>
                        @foreach ($errors->get('NombreSede') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>

            <div class="row col-12">
                <div class="col-6">
                    <label for="Municipio" class="form-label">Municipio</label>
                    <input type="text" class="form-control" name="Municipio" value=" {{ old('Municipio',$item->Municipio) }} ">
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
                    <input type="text" class="form-control" name="Barrio" value=" {{ old('Barrio',$item->Barrio) }} ">
                    @error('Barrio')
                        <div>
                            @foreach ($errors->get('Barrio') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <label for="Direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="Direccion" value=" {{ old('Direccion',$item->Direccion) }} ">
                @error('Direccion')
                    <div>
                        @foreach ($errors->get('Direccion') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>
            @endforeach

            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                <a href=" {{ url('sede/listar') }} "><button type="button"
                        class="btn btn-primary btn-danger">Cancelar</i></button></a>
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