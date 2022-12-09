@extends('../layouts/home')



@section('title', 'Productos')

@push('styles')
{{-- Csrf para funcionamiento de Ajax --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                <h1>Gestión de productos</h1>
            </div>
        </center>


        @if (in_array(123, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('productoadicion')">Nuevo Producto
                    <i class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

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
                        <td>
                            @if (in_array(135, $permisos))
                                <a href="{{ url('producto/editar/' . $item->ProductoId) }}"><button
                                        class="btn btn-primary"><i class="fa-solid fa-pen"></i></button></a>
                            @endif
                        </td>
                        <td>{{ $item->ProductoId }}</td>
                        <td>{{ $item->NombreEmpresa }}</td>
                        <td> {{ $item->NombreProducto }} </td>
                        <td> {{ $item->Tipo }} </td>
                        <td> {{ $item->Talla }} </td>
                        <td> {{ $item->PrecioVenta }} </td>
                        <td> {{ $item->Cantidad }} </td>
                        <td>
                            @if (in_array(147, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" {{ $checkstate }} onclick="changeState('{{$item->ProductoId}}')">
                                </div>
                            @endif
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

                    <label for="Nit" class="form-label">Proveedor</label>
                    <select name="Nit" class="form-select deporte_select">
                        <option value="">Seleccione el Proveedor</option>
                        @foreach ($proveedores as $item)
                            <option value=' {{ $item->Nit }} '>{{ $item->NombreEmpresa }}</option>
                        @endforeach
                    </select>
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
                            <input type="text" class="form-control" name="NombreProducto"
                                value=" {{ old('NombreProducto') }} ">
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
                            <select name="TipoProducto" class="form-select deporte_select">
                                <option>Seleccione el Tipo</option>
                                @foreach ($tipos_productos as $item)
                                    <option value=' {{ $item->TipoId }} '>{{ $item->Tipo }}</option>
                                @endforeach
                            </select>
                            @error('TipoProducto')
                                <div>
                                    @foreach ($errors->get('TipoProducto') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>

                    <label for="Talla" class="form-label">Talla</label>
                    <select name="Talla" class="form-select deporte_select">
                        <option value="">Selecciona Talla</option>
                        @foreach ($tallas as $item)
                            <option value=' {{ $item->TallaId }} '>{{ $item->Talla }}</option>
                        @endforeach
                    </select>
                    @error('Talla')
                        <div>
                            @foreach ($errors->get('Talla') as $item)
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
    <script src=" {{ asset('./js/Programacion/producto.js') }} "></script>
@endpush
