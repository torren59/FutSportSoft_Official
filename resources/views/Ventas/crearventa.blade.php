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
    <form action="" method="post">
        @csrf
        <div class="grid_triple_center">
            <div class="grid_span_2a3">

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

                        <table id="tabla">
                            <thead>
                                <tr>
                                    <td>Producto</td>
                                    <td>Cantidad</td>
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

                                        <td><input type="number" name="{{ $item->ProductoId }}"></td>

                                        <td>{{ $item->Cantidad }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

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
