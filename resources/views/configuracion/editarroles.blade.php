@extends('../layouts/home')



@section('title', 'Editar Roles')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($roldata as $item)
        <form action={{ url('roles/actualizar') }} method="post">
    @endforeach

    @csrf
    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="card p-2 col-6 text-center">

                <h1>Editar Roles</h1>


                @foreach ($roldata as $item)
                <div class="row justify-content-center">
                    <div class="col-6">
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

                    <div class="col-12">
                        <label for="IdRol" class="form-label"></label>
                        <input type="hidden" class="form-control" name="IdRol" value="{{ $item->id }}">
                        @error('IdRol')
                            <div>
                                @foreach ($errors->get('IdRol') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
                </div>
                @endforeach
                <div class="grid_doble_superderecharoles">
                    <div class="grid_span_1">
                        <h1>Listado de permisos</h1>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Selecciona</td>
                                    <td>Permiso</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($total_permisos as $item)
                                    <tr>
                                        <td>
                                            @if (in_array($item->PermisoId, $permisos_checked))
                                                <input name="chequeados[]" type="checkbox" checked
                                                    value="{{ $item->PermisoId }}">
                                            @else
                                                <input name="chequeados[]" type="checkbox" value="{{ $item->PermisoId }}">
                                            @endif
                                        </td>
                                        <td>
                                            <label class="form-check-label"
                                                for="{{ $item->PermisoId }}">{{ $item->NombrePermiso }}
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
