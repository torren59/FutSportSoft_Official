@extends('../layouts/home')



@section('title', 'Editar Roles')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($roldata as $item)
        <form action={{ url('roles/actualizar/'.$item->id) }} method="post">
    @endforeach

    @csrf
    <div class="grid_triple_center">
        <div class="grid_span_2a3">
            <div class="adicion_title">
                <h1>Editar Roles</h1>
            </div>

            @foreach ($roldata as $item)
            <div class="col-12">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" value="{{ old('name',$item->name) }}">
                @error('name')
                    <div>
                        @foreach ($errors->get('name') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>




            @endforeach

            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                <a href=" {{ url('roles/listar') }} "><button type="button"
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
