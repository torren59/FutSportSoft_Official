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
        <form action={{ url('producto/actualizar/'.$item->ProductoId) }} method="post">
    @endforeach

    @csrf
    <div class="grid_triple_center">
        <div class="grid_span_2a3">
            <div class="adicion_title">
                <h1>Editar Producto</h1>
            </div>

            @foreach ($productodata as $item)
            <div class="col-12">
                <label for="Nit" class="form-label">Nit</label>
                <input type="text" class="form-control" name="Nit" value="{{ old('Nit',$item->Nit) }}">
                @error('Nit')
                    <div>
                        @foreach ($errors->get('Nit') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>

            <div class="row col-12">
                <div class="col-6">
                    <label for="NombreProducto" class="form-label">NombreProducto</label>
                    <input type="text" class="form-control" name="NombreProducto" value=" {{ old('NombreProducto',$item->NombreProducto) }} ">
                    @error('NombreProducto')
                        <div>
                            @foreach ($errors->get('NombreProducto') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="TipoProducto" class="form-label">TipoProducto</label>
                    <input type="text" class="form-control" name="TipoProducto" value=" {{ old('TipoProducto',$item->TipoProducto) }} ">
                    @error('TipoProducto')
                        <div>
                            @foreach ($errors->get('TipoProducto') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <label for="Talla" class="form-label">Talla</label>
                <input type="text" class="form-control" name="Talla" value=" {{ old('Talla',$item->Talla) }} ">
                @error('Talla')
                    <div>
                        @foreach ($errors->get('Talla') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <label for="PrecioVenta" class="form-label">PrecioVenta</label>
                <input type="text" class="form-control" name="PrecioVenta" value=" {{ old('PrecioVenta',$item->PrecioVenta) }} ">
                @error('PrecioVenta')
                    <div>
                        @foreach ($errors->get('PrecioVenta') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <label for="Cantidad" class="form-label">Cantidad</label>
                <input type="text" class="form-control" name="Cantidad" value=" {{ old('Cantidad',$item->Cantidad) }} ">
                @error('Cantidad')
                    <div>
                        @foreach ($errors->get('Cantidad') as $item)
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