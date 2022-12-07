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
                                @if ($errors->any()) value = "{{ old('Nombre') }}"
                            @else
                            value= "{{ $item->Nombre }}" @endif>
                            @error('Nombre')
                                <div>
                                    @foreach ($errors->get('Nombre') as $NombreError)
                                        <small> {{ $NombreError }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                        <div class="col-6">
                            <label for="Celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" name="Celular"
                                @if ($errors->any()) value = "{{ old('Celular') }}"
                            @else
                            value= "{{ $item->Celular }}" @endif>
                            @error('Celular')
                                <div>
                                    @foreach ($errors->get('Celular') as $CelularError)
                                        <small> {{ $CelularError }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                        <div class="col-6">

                            <label for="roles" class="form-label">Roles</label>
                            <select class="form-select" name="RolId" aria-label="Default select example">
                                <option selected value="{{ $item->RolId }}">{{ $item->name }}</option>
                                @foreach ($data['roles'] as $item2)
                                    <option value="{{ $item2->id }}">{{ $item2->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-6">
                            <label for="FechaNacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="FechaNacimiento"
                                @if ($errors->any()) value = {{ old('FechaNacimiento') }}
                            @else
                            value={{ $item->FechaNacimiento }} @endif>
                            @error('FechaNacimiento')
                                <div>
                                    @foreach ($errors->get('FechaNacimiento') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>




                        <div class="col-6">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="email"
                                @if ($errors->any()) value = "{{ old('email') }}"
                            @else
                            value= "{{ $item->email }}" @endif>
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
                                @if ($errors->any()) value = "{{ old('Direccion') }}"
                            @else
                            value="{{ $item->Direccion }}" @endif>
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

    {{-- <script>
        flatpickr("input[type=text-local]",{})
    </script> --}}
@endpush
