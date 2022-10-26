@extends('../layouts/home')

@section('title', 'Crear venta')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <form action="/venta/store" method="post">
        @csrf
        <div class="grid_triple_center">
            <div class="grid_span_2a3">

                <label for="NumeroFactura" class="form-label">Numero de Factura</label>
                            <input type="text" class="form-control" name="NumeroFactura"
                                value="{{ old('NumeroFactura') }}">
                                
                <div class="grid_doble_simetrico">

                    <div class="grid_span_1" id="product_added">
                        <div>
                            <h3>PRODUCTOS AGREGADOS</h3>
                        </div>
                        <div class="col-12 lista_selects">
                            {{-- Aqui se inserta con js los productos seleccionados --}}
                        </div>
                    </div>

                    <div class="grid_span_1">
                        <input type="number" name="totalproduct" id="total_venta_article" hidden value="0">

                        <table id="tabl">
                            <thead>
                                <tr>
                                    <td>Producto</td>
                                    <td>Cantidad</td>
                                    <td>Valor Unitario</td>
                                    <td>Disponibles</td>
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

                                        <td><input type="number" name="{{ $item->ProductoId }}_cantidad"></td>
                                        <td><input type="number" name=" {{ $item->ProductoId }}_unitValue"></td>

                                        <td>{{ $item->Cantidad }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>

                <br>
                <button type="submit">Enviar</button>

            </div>
        </div>

    </form>

    {{-- Tabla experimental, No usar --}}
    <table id="tabla">
        <thead>
            <tr>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Valor Unitario</td>
                <td>Disponibles</td>
            </tr>
        </thead>
        <tbody>
            
                <tr class="tr_backgrouned">
                   
                    <td>Producto Uno</td>
                    <td>10</td>
                    <td>8500</td>
                    <td>Si</td>
                
                </tr>
            
        </tbody>
    </table>

    @if ($errors->any())
        <h1>Es necesario que cantidades y valores unitarios de los productos seleccionados tengan valores mínimos de 1 y 0 
            respectivamente</h1>
    @endif

@endsection

@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
@endpush
