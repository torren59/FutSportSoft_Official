@extends('../layouts/home')



@section('title', 'Editar Roles')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($roldata as $item)
        <form action={{ url('roles/actualizar/' . $item->id) }} method="post">
    @endforeach

    @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-5 col-6 text-center">

                    <h1>Editar Roles</h1>


                @foreach ($roldata as $item)
                    <div class="col-12">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $item->name) }}">
                        @error('name')
                            <div>
                                @foreach ($errors->get('name') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
                @endforeach
                <br>
                <div class="botones">
                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                    <a href=" {{ url('roles/listar') }} "><button type="button"
                            class="btn btn-outline-secondary">Cancelar</i></button></a>
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
