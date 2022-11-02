@extends('../layouts/home')

@section('title', 'Crear Compra')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <form action="{{ url('compras/store') }}" method="post">
        @csrf
        <div class="grid_triple_center">
            <div class="grid_span_2a3">
                <div class="container p-5">
                    <div class="row" style="gap:2rem">
                        <div class="card col-3">
                            <label for="NumeroFactura" class="form-label">Numero de Factura</label>
                            <input type="number" class="form-control" name="NumeroFactura"
                                value="{{ old('NumeroFactura') }}">
                            @error('NumeroFactura')
                                <div>
                                    @foreach ($errors->get('NumeroFactura') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror

                            <label for="Nit" class="form-label">Nit</label>
                            <input type="number" class="form-control" name="Nit" value="{{ old('Nit') }}">
                            @error('Nit')
                                <div>
                                    @foreach ($errors->get('Nit') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror

                            <label for="FechaCompra" class="form-label">Fecha de la Compra</label>
                            <input type="date" class="form-control" name="FechaCompra" value="{{ old('FechaCompra') }}">
                            @error('FechaCompra')
                                <div>
                                    @foreach ($errors->get('FechaCompra') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror

                            <label for="ValorCompra" class="form-label">Total de la Compra</label>
                            <input readonly type="number" class="form-control" id="PrecioTotal" name="ValorCompra"
                                value="{{ old('ValorCompra') }}">
                            @error('ValorCompra')
                                <div>
                                    @foreach ($errors->get('ValorCompra') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror

                            <label for="SubTotal" class="form-label">Sub Total</label>
                            <input readonly type="number" class="form-control" id="SubTotal" name="SubTotal"
                                value="{{ old('SubTotal') }}">
                            @error('SubTotal')
                                <div>
                                    @foreach ($errors->get('SubTotal') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror

                            <label for="Iva" class="form-label">Iva</label>
                            <input readonly type="number" class="form-control" id="Iva" name="Iva"
                                value="{{ old('Iva') }}">
                            @error('Iva')
                                <div>
                                    @foreach ($errors->get('Iva') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror

                            <label for="Descuento" class="form-label">Descuento</label>
                            <input type="number" id="Descuento" class="form-control Descuento" name="Descuento"
                                value="{{ old('Descuento') }}">
                            @error('Descuento')

                                @foreach ($errors->get('Descuento') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                            <a href="{{ url('compras/listar/') }}"><button type="button"
                                    class="btn btn-outline-secondary">Cancelar</i></button></a>
                        </div>



                        <div class="card col-8">
                            <div class="grid_doble_superderecha">

                                <div class="grid_span_1" id="product_added">
                                    <div class="text-center">
                                        <h1>PRODUCTOS AGREGADOS</h1>
                                    </div>
                                    <div class="col-12 lista_selects">
                                        {{-- Aqui se inserta con js los productos seleccionados --}}
                                    </div>
                                </div>

                                <div class="grid_span_1">


                                    <table id="tabla">
                                        <thead>
                                            <tr>
                                                <td>Producto</td>
                                                <td>Cantidad</td>
                                                <td>Valor Unitario</td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($productos as $item)
                                                <tr>
                                                    <td>
                                                        <div class="lista_productos">
                                                            <input type="checkbox" class="form-check-input productcheck"
                                                                id="{{ $item->ProductoId }}" name="productos[]"
                                                                value="{{ $item->ProductoId }}">
                                                            <label class="form-check-label"
                                                                for="{{ $item->ProductoId }}">{{ $item->NombreProducto }}
                                                            </label>
                                                        </div>
                                                    </td>

                                                    <td><input type="number" class="Cantidad"
                                                            id="Cantidad{{ $item->ProductoId }}"
                                                            name="{{ $item->ProductoId }}_cantidad"></td>
                                                    <td><input type="number" Class="ValorUnitario"
                                                            id="ValorUnitario{{ $item->ProductoId }}"
                                                            name=" {{ $item->ProductoId }}_unitValue"></td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>


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
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
@endpush
