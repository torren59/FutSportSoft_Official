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
    <div class="grid_triple_center">
        <div class="grid_span_2a3">
            <div class="adicion_title">
                <h1>Editar Proveedor</h1>
            </div>
            @foreach ($proveedordata as $item)
                <div class="col-12">
                    <label for="NombreEmpresa" class="form-label">Nombre Empresa</label>
                    <input type="text" class="form-control" name="NombreEmpresa" value="{{ old('NombreEmpresa', $item->NombreEmpresa) }}">
                    @error('NombreEmpresa')
                        <div>
                            @foreach ($errors->get('NombreEmpresa') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>

                <div class="row col-12">
                    <div class="col-6">
                        <label for="Titular" class="form-label">Titular</label>
                        <input type="text" class="form-control" name="Titular"
                            value=" {{ old('Titular', $item->Titular) }}">
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
                            value=" {{ old('NumeroContacto', $item->NumeroContacto) }} ">
                        @error('NumeroContacto')
                            <div>
                                @foreach ($errors->get('NumeroContacto') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label for="Correo" class="form-label">Correo</label>
                    <input type="text" class="form-control" name="Correo" value=" {{ old('Correo', $item->Correo) }} ">
                    @error('Correo')
                        <div>
                            @foreach ($errors->get('Correo') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="Direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="Direccion"
                        value=" {{ old('Direccion', $item->Direccion) }} ">
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
                <a href=" {{ url('producto/listar') }} "><button type="button"
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
