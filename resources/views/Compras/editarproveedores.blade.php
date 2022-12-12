@extends('../layouts/home')



@section('title', 'Editar proveedor')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($proveedordata as $item)
        <form action={{ url('proveedor/actualizar/' . $item->Nit) }} method="post">
    @endforeach

    @csrf
    <div class="container p-5 text-center">
        <div class="row justify-content-center p-5">
            <div class="card col-6">
                <h1>Editar Proveedor</h1>

                @foreach ($proveedordata as $item)
                    <div class="row justify-content-center p-2">
                        <div class="col-8">
                            <label for="NombreEmpresa" class="form-label">Nombre Empresa</label>
                            <input type="text" class="form-control" name="NombreEmpresa"
                                @if ($errors->any()) value = "{{ old('NombreEmpresa') }}"
                        @else
                        value= "{{ $item->NombreEmpresa }}" @endif>
                            @error('NombreEmpresa')
                                <div>
                                    @foreach ($errors->get('NombreEmpresa') as $NombreError)
                                        <small> {{ $NombreError }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>




                        <div class="col-6">
                            <label for="Titular" class="form-label">Titular</label>
                            <input type="text" class="form-control" name="Titular"
                                @if ($errors->any()) value = "{{ old('Titular') }}"
                        @else
                        value="{{ $item->Titular }}" @endif>
                            @error('Titular')
                                <div>
                                    @foreach ($errors->get('Titular') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="NumeroContacto" class="form-label">Numero Contacto</label>

                            <input type="text" class="form-control" name="NumeroContacto"
                                @if ($errors->any()) value = "{{ old('NumeroContacto') }}"
                        @else
                        value= "{{ $item->NumeroContacto }}" @endif>


                            @error('NumeroContacto')
                                <div>
                                    @foreach ($errors->get('NumeroContacto') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                        <div class="col-6">
                            <label for="Correo" class="form-label">Correo</label>
                            <input type="mail" class="form-control" name="Correo"
                                @if ($errors->any()) value = "{{ old('Correo') }}"
                    @else
                    value= "{{ $item->Correo }}" @endif>
                            @error('Correo')
                                <div>
                                    @foreach ($errors->get('Correo') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="Direccion" class="form-label">Dirección</label>
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
                    </div>
                @endforeach

                <div class="botonesproveedor p-5">
                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                    <a href=" {{ url('proveedor/listar') }} "><button type="button"
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
