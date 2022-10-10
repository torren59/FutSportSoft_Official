@extends('../layouts/home')



@section('title', 'Editar venta')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @foreach ($ventadata as $item)
        <form action={{ url('venta/actualizar/'.$item->VentaId) }} method="post">
    @endforeach

    @csrf
    <div class="grid_triple_center">
        <div class="grid_span_2a3">
            <div class="adicion_title">
                <h1>Editar Venta</h1>
            </div>

            @foreach ($ventadata as $item)
            <div class="col-12">
                <label for="Documento" class="form-label">Documento</label>
                <input type="text" class="form-control" name="Documento" value="{{ old('Documento',$item->Documento) }}">
                @error('Documento')
                    <div>
                        @foreach ($errors->get('Documento') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>

            <div class="row col-12">
                <div class="col-6">
                    <label for="FechaVenta" class="form-label">FechaVenta</label>
                    <input type="text" class="form-control" name="FechaVenta" value=" {{ old('FechaVenta',$item->FechaVenta) }} ">
                    @error('FechaVenta')
                        <div>
                            @foreach ($errors->get('FechaVenta') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="ValorVenta" class="form-label">ValorVenta</label>
                    <input type="text" class="form-control" name="ValorVenta" value=" {{ old('ValorVenta',$item->ValorVenta) }} ">
                    @error('ValorVenta')
                        <div>
                            @foreach ($errors->get('ValorVenta') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <label for="SubTotal" class="form-label">SubTotal</label>
                <input type="text" class="form-control" name="SubTotal" value=" {{ old('SubTotal',$item->SubTotal) }} ">
                @error('SubTotal')
                    <div>
                        @foreach ($errors->get('SubTotal') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>
            @endforeach

            <div class="col-12">
                <label for="IVA" class="form-label">IVA</label>
                <input type="text" class="form-control" name="IVA" value="{{ old('IVA',$item->IVA) }}">
                @error('IVA')
                    <div>
                        @foreach ($errors->get('IVA') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <label for="Descuento" class="form-label">Descuento</label>
                <input type="text" class="form-control" name="Descuento" value="{{ old('Descuento',$item->Descuento) }}">
                @error('Descuento')
                    <div>
                        @foreach ($errors->get('Descuento') as $item)
                            <small> {{ $item }} </small>
                        @endforeach
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                <a href=" {{ url('venta/listar') }} "><button type="button"
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