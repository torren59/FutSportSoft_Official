@extends('../layouts/home')



@section('title', 'Editar Roles')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($grupodata as $item)
        <form action={{ url('grupos/actualizar') }} method="post">
    @endforeach

    @csrf
    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="card p-4 col-6 text-center">

                <h1>Editar Grupos</h1>


                @foreach ($grupodata as $item)
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <label for="NombreGrupo" class="form-label">Grupo</label>
                            <input type="text" class="form-control" name="NombreGrupo"
                                @if ($errors->any()) value = "{{ old('NombreGrupo') }}"
                            @else
                            value="{{ $item->NombreGrupo }}" @endif>
                            @error('NombreGrupo')
                                <div>
                                    @foreach ($errors->get('NombreGrupo') as $NombreError)
                                        <small> {{ $NombreError }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="roles" class="form-label">Categoria</label>
                            <select class="form-select" name="CategoriaId" aria-label="Default select example">
                                <option selected value="{{ $item->CategoriaId }}">{{ $item->NombreCategoria }}</option>
                                @foreach ($total_categorias as $item2)
                                    <option value="{{ $item2->CategoriaId }}">{{ $item2->NombreCategoria }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-6">
                            <label for="Documento" class="form-label">Encargado</label>
                            <select class="form-select" name="Documento" aria-label="Default select example">
                                <option selected value="{{ $item->Documento }}">{{ $item->Nombre }}</option>
                                @foreach ($total_usuarios as $item2)
                                    <option value="{{ $item2->Documento }}">{{ $item2->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="IdGrupo" class="form-label"></label>
                        <input type="hidden" class="form-control" name="IdGrupo"
                            @if ($errors->any()) value = "{{ old('IdGrupo') }}"
                        @else
                        value="{{ $item->GrupoId }}" @endif>
                        @error('IdGrupo')
                            <div>
                                @foreach ($errors->get('IdGrupo') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
                @endforeach
                <h1>Listado de deportistas</h1>
                <div class="grid_doble_superderechagrupos">
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
                                            @if (in_array($item->Documento, $deportistas_checked))
                                                <input name="chequeados[]" type="checkbox" checked
                                                    value="{{ $item->Documento }}">
                                            @else
                                                <input name="chequeados[]" type="checkbox" value="{{ $item->Documento }}">
                                            @endif
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
                    <a href=" {{ url('grupos/listar') }} "><button type="button"
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
