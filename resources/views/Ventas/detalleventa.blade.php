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
            <div class="adicion_title">
                <h1>Detalle De Venta</h1>
            </div>
            @foreach ($detalleventa as $item)
                <div class="col-6">
                    <label for="Fecha" class="form-label">Nombre</label>
                    <input disabled type="text" class="form-control" name="FechaVenta" value = "{{$item->Nombre}}">
                </div>

                <div class="col-6">
                    <label for="FechaVenta" class="form-label">Fecha Venta</label>
                    <input disabled type="date" class="form-control" name="FechaVenta" value = "{{$item->FechaVenta}}">
                </div>

                <div class="col-6">
                    <label for="FechaVenta" class="form-label">SubTotal</label>
                    <input disabled type="text" class="form-control" name="FechaVenta" value = "{{$item->SubTotal}}">
                </div>

                <div class="col-6">
                    <label for="FechaVenta" class="form-label">Iva</label>
                    <input disabled type="text" class="form-control" name="FechaVenta" value = "{{$item->Iva}}">
                </div>

                <div class="col-6">
                    <label for="FechaVenta" class="form-label">Total</label>
                    <input disabled type="text" class="form-control" name="FechaVenta" value = "{{$item->ValorVenta}}">
                </div>



                

   
            @endforeach

            <div class="col-12">
            <h2> Articulos Vendidos </h2>
            @foreach ($articulosVendidos as $item)
            Nombre Producto: {{$item->NombreProducto}} <br>
            Cantidad: {{$item->Cantidad}} <br>
            Precio Venta: {{$item->PrecioVenta}} <br>
            <hr>
                
            @endforeach

            </div>
            <div class="col-6">
                <a href=" {{ url('venta/listar') }} "><button type="button"
                        class="btn btn-primary btn-danger">Volver al listado</i></button></a>
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