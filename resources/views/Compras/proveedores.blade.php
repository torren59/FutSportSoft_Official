@extends('../layouts/home')



@section('title', 'Proveedores')

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

            <h1>Gestión de proveedores</h1>

        </center>

        @if (in_array(122, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('proveedoradicion')">Nuevo Proveedor
                    <i class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Nit</td>
                    <td>Nombre Empresa</td>
                    <td>Titular</td>
                    <td>Numero Contacto</td>
                    <td>Correo</td>
                    <td>Dirección</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td>

                            @if (in_array(134, $permisos))
                                <a href="{{ url('proveedor/editar/' . $item->Nit) }}"><button
                                        class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></button></a>
                            @endif
                        </td>
                        <td>{{ $item->Nit }}</td>
                        <td> {{ $item->NombreEmpresa }} </td>
                        <td> {{ $item->Titular }} </td>
                        <td> {{ $item->NumeroContacto }} </td>
                        <td> {{ $item->Correo }} </td>
                        <td> {{ $item->Direccion }} </td>
                        <td>
                            @if (in_array(146, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" {{ $checkstate }}
                                        onclick="changeState2({{ $item->Nit }})">
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Creacion de productos --}}

        <div id="proveedoradicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h2 style="padding-top:5%;">Nuevo Proveedor</h2>


                <form action={{ url('proveedor/crear') }} method="post"> @csrf
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <label for="Nit" class="form-label">Nit</label>
                            <input type="number" class="form-control" name="Nit" value="{{ old('Nit') }}">
                            @error('Nit')
                                <div>
                                    @foreach ($errors->get('Nit') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="NombreEmpresa" class="form-label">Nombre Empresa</label>
                            <input type="text" class="form-control" name="NombreEmpresa"
                                value=" {{ old('NombreEmpresa') }} ">
                            @error('NombreEmpresa')
                                <div>
                                    @foreach ($errors->get('NombreEmpresa') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="Titular" class="form-label">Titular</label>
                            <input type="text" class="form-control" name="Titular" value=" {{ old('Titular') }} ">
                            @error('Titular')
                                <div>
                                    @foreach ($errors->get('Titular') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="NumeroContacto" class="form-label">Numero Contacto</label>
                            <input type="number" class="form-control" name="NumeroContacto"
                                value=" {{ old('NumeroContacto') }} ">
                            @error('NumeroContacto')
                                <div>
                                    @foreach ($errors->get('NumeroContacto') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="Correo" class="form-label">Correo</label>
                            <input type="text" class="form-control" name="Correo" value=" {{ old('Correo') }} ">
                            @error('Correo')
                                <div>
                                    @foreach ($errors->get('Correo') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="Direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="Direccion" value=" {{ old('Direccion') }} ">
                            @error('Direccion')
                                <div>
                                    @foreach ($errors->get('Direccion') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="botonesproveedor p-5"><button type="submit"
                            class="btn btn-outline-primary">Guardar</i></button>
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="switchadicion2('proveedoradicion')">Cancelar</i></button>
                    </div>


                </form>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('proveedoradicion');
                }, 500);
            </script>
        @endif

    </div>

     {{-- Mensajes personalizados --}}
     @if (isset($sweet_setAll))
     <script>
         setTimeout(() => {
             swal_setAll("{{ $sweet_setAll['title'] }}", "{{ $sweet_setAll['msg'] }}",
                 "{{ $sweet_setAll['type'] }}");
         }, 500);
     </script>
 @endif
@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/layouts/Compras/proveedores.js') }} "></script>
@endpush
