@extends('../layouts/home')



@section('title', 'Detalle Ventas')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')


    @csrf
    <div class="grid_triple_center">
        <div class="grid_span_2a3">

            <div class="container col-4 p-5">
                <div class="row justify-content-center">
                    <div class="card text-center">


                        <h1>Detalle De Venta</h1>

                        @foreach ($detalleventa as $item)
                            <div class="row justify-content-center p-5">
                                <div class="col-12">
                                    <label for="Fecha" class="form-label">Nombre</label>
                                    <input disabled type="text" class="form-control" name="FechaVenta"
                                        value="{{ $item->Nombre }}">
                                </div>

                                <div class="col-12">
                                    <label for="FechaVenta" class="form-label">Fecha Venta</label>
                                    <input disabled type="date" class="form-control" name="FechaVenta"
                                        value="{{ $item->FechaVenta }}">
                                </div>

                                <div class="col-12">
                                    <label for="FechaVenta" class="form-label">SubTotal</label>
                                    <input disabled type="text" class="form-control" name="FechaVenta"
                                        value="{{ $item->SubTotal }}">
                                </div>

                                <div class="col-12">
                                    <label for="FechaVenta" class="form-label">Iva</label>
                                    <input disabled type="text" class="form-control" name="FechaVenta"
                                        value="{{ $item->Iva }}">
                                </div>

                                <div class="col-12">
                                    <label for="FechaVenta" class="form-label">Total</label>
                                    <input disabled type="text" class="form-control" name="FechaVenta"
                                        value="{{ $item->ValorVenta }}">
                                </div>

                                <div class="col-12">
                                    <label for="FechaVenta" class="form-label">Descuento</label>
                                    <input disabled type="text" class="form-control" name="FechaVenta"
                                        value="{{ $item->Descuento }}">
                                </div>

                                @php
                                    $SuperTot = intval($item->ValorVenta) + intval($item->Descuento);
                                @endphp

                                <div class="col-12">
                                    <label for="FechaVenta" class="form-label">Total sin descuento</label>
                                    <input disabled type="text" class="form-control" name="FechaVenta"
                                        value="{{ $SuperTot }}">
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="container col-6 p-5">
            <div class="row justify-content-center">
                <div class="card">

                    <h2> Articulos Vendidos </h2>

                    @foreach ($articulosVendidos as $item)


                        <div style="width:100%;height:auto;box-shadow: 0px 10px 10px -6px black;margin:5px;">
                            <div class="floatcontent">
                                Nombre Producto: {{ $item->NombreProducto }} <br>
                                Cantidad: {{ $item->Cantidad }} <br>
                                Valor unitario: {{ $item->PrecioVenta }} <br>
                                @php
                                    $TotProd = intval($item->Cantidad) * intval($item->PrecioVenta);
                                @endphp
                                Total: {{ $TotProd }}
                            </div>
                        </div>
                    @endforeach
                    <div style="margin-bottom: 10%;visibility:hidden"></div>
                </div>
            </div>
        </div>

        <div class="col-12" style="position: fixed; bottom: 5%;">
            <center>
                <a href=" {{ url('venta/listar') }} "><button type="button" class="btn btn-outline-secondary">Volver
                        al
                        listado</i></button></a>
            </center>
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
