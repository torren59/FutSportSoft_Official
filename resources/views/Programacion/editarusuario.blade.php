@extends('../layouts/home')



@section('title', 'Editar Usuario')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($usuariodata as $item)
        <form action={{ url('usuario/actualizar/'.$item->Documento) }} method="post">
    @endforeach

    @csrf
    <div class="grid_triple_center">
        <div class="grid_span_2a3">
            <div class="adicion_title">
                <h1>Editar Usuario</h1>
            </div>

            @foreach ($usuariodata as $item)
            <div class="col-12">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="Nombre" value="{{ old('Nombre',$item->Nombre) }}">
                @error('Nombre')
                    <div>
                        @foreach ($errors->get('Nombre') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>

            <div class="row col-12">
                <div class="col-6">
                    <label for="RolId" class="form-label">Rol</label>
                    <input type="text" class="form-control" name="RolId" value=" {{ old('RolId',$item->RolId) }} ">
                    @error('RolId')
                        <div>
                            @foreach ($errors->get('RolId') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="Celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" name="Celular" value=" {{ old('Celular',$item->Celular) }} ">
                    @error('Celular	')
                        <div>
                            @foreach ($errors->get('Celular	') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label for="Correo" class="form-label">Correo</label>
                <input type="text" class="form-control" name="Correo" value=" {{ old('Correo',$item->Correo) }} ">
                @error('Correo')
                    <div>
                        @foreach ($errors->get('Correo') as $item)
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

            <div class="col-6">
                <label for="FechaNacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="text" class="form-control" name="FechaNacimiento" value=" {{ old('FechaNacimiento',$item->FechaNacimiento) }} ">
                @error('FechaNacimiento')
                    <div>
                        @foreach ($errors->get('FechaNacimiento') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <label for="Clave" class="form-label">Clave</label>
            <input type="text" class="form-control" name="Clave" value=" {{ old('Celular',$item->Clave) }} ">
            @error('Clave')
                <div>
                    @foreach ($errors->get('Clave') as $item)
                        <small> {{ $item }} </small>
                    @endforeach
                </div>
            @enderror
        </div>
    </div>
            @endforeach

            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                <a href=" {{ url('usuario/listar') }} "><button type="button"
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
