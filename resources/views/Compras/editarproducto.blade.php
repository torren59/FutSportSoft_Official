@extends('../layouts/home')



@section('title', 'Editar producto')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($productodata as $item)
        <form action={{ url('producto/actualizar/' . $item->ProductoId) }} method="post">
    @endforeach

    @csrf

    <div class="container col-4 p-5 text-center">
        <div class="row justify content center p-2">
            <div class="card">
                <h1>Editar Producto</h1>

                @foreach ($productodata as $item)
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <label for="Nit" class="form-label">Empresa</label>
                            <select class="form-select" name="Nit" aria-label="Default select example">
                                <option selected value="{{ $item->Nit }}">{{ $item->NombreEmpresa}}</option>
                                @foreach ($proveedores as $item2)
                                    <option value="{{ $item2['proveedores.Nit'] }}">{{ $item2->NombreEmpresa }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-6">
                            <label for="NombreProducto" class="form-label">Nombre Producto</label>
                            <input type="text" class="form-control" name="NombreProducto"
                                value="{{ old('NombreProducto', $item->NombreProducto) }}">
                            @error('NombreProducto')
                                <div>
                                    @foreach ($errors->get('NombreProducto') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="TipoProducto" class="form-label">Tipo</label>
                            <select class="form-select" name="TipoProducto" aria-label="Default select example">
                                <option selected value="{{ $item->TipoProducto}}">{{ $item->Tipo}}</option>
                                @foreach ($proveedores as $item2)
                                    <option value="{{ $item2->TipoId }}">{{ $item2->Tipo }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-6">
                            <label for="TipoProducto" class="form-label">Talla</label>
                            <select class="form-select" name="Talla" aria-label="Default select example">
                                <option selected value="{{ $item->Talla}}">{{ $item->Talla}}</option>
                                @foreach ($proveedores as $item2)
                                    <option value="{{ $item2->TallaId }}">{{ $item2->Talla }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="PrecioVenta" class="form-label">PrecioVenta</label>
                            <input type="number" class="form-control" name="PrecioVenta"
                                value="{{ old('PrecioVenta', $item->PrecioVenta) }}">
                            @error('PrecioVenta')
                                <div>
                                    @foreach ($errors->get('PrecioVenta') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="Cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" name="Cantidad"
                                value="{{ old('Cantidad', $item->Cantidad) }}">
                            @error('Cantidad')
                                <div>
                                    @foreach ($errors->get('Cantidad') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                    </div>
                @endforeach
                <div class="botonesproductos p-5">
                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                    <a href=" {{ url('producto/listar') }} "><button type="button"
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
