@extends('../layouts/home')



@section('title', 'Productos')

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
                <h1>PRODUCTOS</h1>
            </div>
        </center>

        <div class="addbtn">
            <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('productoadicion')">Nuevo Producto <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>ProductoId</td>
                    <td>Nit</td>
                    <td>Nombre Producto</td>
                    <td>Tipo Producto</td>
                    <td>Talla</td>
                    <td>Precio Venta</td>
                    <td>Cantidad</td>
                    <td>Estado</td>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td><a href="{{ url('producto/editar/' . $item->ProductoId) }}"><button class="btn btn-primary"><i
                                        class="fa-solid fa-pen"></i></button></a></td>
                        <td>{{ $item->ProductoId }}</td>
                        <td>{{ $item->Nit }}</td>
                        <td> {{ $item->NombreProducto }} </td>
                        <td> {{ $item->TipoProducto }} </td>
                        <td> {{ $item->Talla }} </td>
                        <td> {{ $item->PrecioVenta }} </td>
                        <td> {{ $item->Cantidad }} </td>
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

        {{-- Creacion de productos --}}

        <div id="productoadicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Nuevo Producto</h4>
                <hr>

                <form action={{ url('producto/crear') }} method="post"> @csrf

                    <label for="Nit" class="form-label">Nit</label>
                    <input type="number" class="form-control" name="Nit" value="{{ old('Nit') }}">
                    @error('Nit')
                        <div>
                            @foreach ($errors->get('Nit') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <div class="row">
                        <div class="col-6">
                            <label for="NombreProducto" class="form-label">Nombre Producto</label>
                            <input type="text" class="form-control" name="NombreProducto" value=" {{ old('NombreProducto') }} ">
                            @error('NombreProducto')
                                <div>
                                    @foreach ($errors->get('NombreProducto') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="TipoProducto" class="form-label">Tipo Producto</label>
                            <input type="text" class="form-control" name="TipoProducto" value=" {{ old('TipoProducto') }} ">
                            @error('TipoProducto')
                                <div>
                                    @foreach ($errors->get('TipoProducto') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>

                    <label for="TallaId" class="form-label">Talla</label>
                    <select name="TallaId" class="form-select deporte_select">
                        <option value="">Selecciona Talla</option>
                        @foreach ($tallas as $item)
                            <option value=' {{ $item->TallaId }} '>{{ $item->Talla }}</option>
                        @endforeach
                    </select>
                    @error('TallaId')
                        <div>
                            @foreach ($errors->get('TallaId') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="PrecioVenta" class="form-label">Precio Venta</label>
                    <input type="number" class="form-control" name="PrecioVenta" value=" {{ old('PrecioVenta') }} ">
                    @error('PrecioVenta')
                        <div>
                            @foreach ($errors->get('PrecioVenta') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="Cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="Cantidad" value=" {{ old('Cantidad') }} ">
                    @error('Cantidad')
                        <div>
                            @foreach ($errors->get('Cantidad') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <button type="button" class="btn btn-primary btn-danger"
                        onclick="switchadicion2('productoadicion')">Cancelar</i></button>

                </form>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('productoadicion');
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