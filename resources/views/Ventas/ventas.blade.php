@extends('../layouts/home')



@section('title', 'Ventas')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    {{-- Listado --}}

    <div class="service_list">
        <center>
            <div class="tituloTabla">
                <h1>VENTAS</h1>
            </div>
        </center>
        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>VentaId</td>
                    <td>Documento</td>
                    <td>FechaVenta</td>
                    <td>ValorVenta</td>
                    <td>SubTotal</td>
                    <td>IVA</td>
                    <td>Descuento</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td><a href="{{ url('venta/editar/' . $item->VentaId) }}"><button class="btn btn-primary"><i
                                        class="fa-solid fa-pen"></i></button></a></td>
                        <td>{{ $item->VentaId }}</td>
                        <td>{{ $item->Documento }}</td>
                        <td> {{ $item->FechaVenta }} </td>
                        <td> {{ $item->ValorVenta }} </td>
                        <td> {{ $item->SubTotal }} </td>
                        <td> {{ $item->IVA }} </td>
                        <td> {{ $item->Descuento }} </td>
                        <td>
                            {{-- Definiendo estado --}}
                            @php
                                $checkstate = '';
                                if ($item->Estado == true) {
                                    $checkstate = 'checked';
                                }
                            @endphp

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                    {{ $checkstate }} >
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="addbtn">
            <button class="btn btn-success col-3" onclick="switchadicion2('ventaadicion')">Nueva Venta <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>

        {{-- Creacion de ventas --}}

        <div id="ventaadicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Nueva Venta</h4>
                <hr>

                <form action={{ url('venta/crear') }} method="post"> @csrf

                    <label for="Documento" class="form-label">Documento</label>
                    <input type="text" class="form-control" name="Documento" value="{{ old('Documento') }}">
                    @error('Documento')
                        <div>
                            @foreach ($errors->get('Documento') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <div class="row">
                        <div class="col-6">
                            <label for="FechaVenta" class="form-label">FechaVenta</label>
                            <input type="date" class="form-control" name="FechaVenta" value=" {{ old('FechaVenta') }} ">
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
                            <input type="text" class="form-control" name="ValorVenta" value=" {{ old('ValorVenta') }} ">
                            @error('ValorVenta')
                                <div>
                                    @foreach ($errors->get('ValorVenta') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>

                    <label for="SubTotal" class="form-label">SubTotal</label>
                    <input type="text" class="form-control" name="SubTotal" value=" {{ old('SubTotal') }} ">
                    @error('SubTotal')
                        <div>
                            @foreach ($errors->get('SubTotal') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="IVA" class="form-label">IVA</label>
                    <input type="text" class="form-control" name="IVA" value="{{ old('IVA') }}">
                    @error('IVA')
                        <div>
                            @foreach ($errors->get('IVA') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="Descuento" class="form-label">Descuento</label>
                    <input type="text" class="form-control" name="Descuento" value="{{ old('Descuento') }}">
                    @error('Descuento')
                        <div>
                            @foreach ($errors->get('Descuento') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <button type="button" class="btn btn-primary btn-danger"
                        onclick="switchadicion2('ventaadicion')">Cancelar</i></button>

                </form>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('ventaadicion');
                }, 500);
            </script>
        @endif

    </div>
@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush
