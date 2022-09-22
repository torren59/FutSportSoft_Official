@extends('../layouts/home')



@section('title', 'Editar deporte')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

    @foreach ($deportedata as $item)
    <form action={{ url('deporte/actualizar/'.$item->DeporteId ) }} method="post">
    @endforeach

        @csrf
        <div class="grid_triple_center">
            <div class="grid_span_2a3">

                <div class="adicion_title">
                    <h1>Editar Deporte</h1>
                </div>


                @foreach ($deportedata as $item)
                    <div class="adicion_content" id="addsed">
                        <div class="mb-3  col-5">
                            <label class="form-label">Nombre Deporte</label>
                            <input type="text" class="form-control" name="NombreDeporte"
                                value=" {{ old('NombreDeporte', $item->NombreDeporte) }} ">
                                @error('NombreDeporte')
                                <div>
                                    @foreach ($errors->get('NombreDeporte') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>
                @endforeach

                <div class="mb-3 col-7">
                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <a href=" {{url('deporte/listar')}} "><button type="button" class="btn btn-primary btn-danger">Cancelar</i></button></a>
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
