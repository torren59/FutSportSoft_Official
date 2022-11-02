@extends('../layouts/home')



@section('title', 'Editar Usuario')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($data['usuarios'] as $item)
        <form action={{ url('usuario/actualizar/' . $item->id) }} method="post"> @csrf
    @endforeach
    <div class="container p-5">
        <div class="row justify-content-center" style="margin-top: 2rem;">
            <div class="card col-6">
                <div class="titulo text-center">
                    <h1>Editar Usuario</h1>
                </div>
                <br>
                <div class="row">
                    @foreach ($data['usuarios'] as $item)
                        <div class="col-6">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="Nombre"
                                value="{{ old('Nombre', $item->Nombre) }}">
                            @error('Nombre')
                                <div>
                                    @foreach ($errors->get('Nombre') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>



                        <div class="col-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" name="password"
                                value=" {{ old('password', $item->password) }}">

                            @error('password')
                                <div>
                                    @foreach ($errors->get('password') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                        <div class="col-4">
                            <label for="Celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" name="Celular"
                                value=" {{ old('Celular', $item->Celular) }}">
                            @error('Celular')
                                <div>
                                    @foreach ($errors->get('Celular') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>



                        <div class="col-4">

                            <label for="roles" class="form-label">Roles</label>
                            <select class="form-select"  name="IdRol" aria-label="Default select example">
                                @foreach ($data['roles'] as $item2)
                                    <option value="{{ $item2->id }}">{{ $item2->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-4">
                            <label for="FechaNacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="text-local" class="form-control" name="FechaNacimiento"
                                value=" {{ old('FechaNacimiento', $item->FechaNacimiento) }}">
                            @error('FechaNacimiento')
                                <div>
                                    @foreach ($errors->get('FechaNacimiento') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                    {{ $item->FechaNacimiento}}
                                </div>
                            @enderror
                        </div>




                        <div class="col-6">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $item->email)}}">
                            @error('email')
                                <div>
                                    @foreach ($errors->get('email') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                        <div class="col-6">
                            <label for="Direccion" class="form-label">Direccion</label>
                            <input type="text" class="form-control" name="Direccion"
                                value="{{ old('Direccion', $item->Direccion) }}">
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

                <div class="botonesusuarios p-5 text-center">
                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                    <a href=" {{ url('usuario/listar') }} "><button type="button"
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("input[type=text-local]",{})
    </script>
@endpush
