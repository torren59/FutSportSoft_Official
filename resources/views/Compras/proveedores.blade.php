@extends('../layouts/home')



@section('title', 'Proveedores')

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
                <h1>PROVEEDORES</h1>
            </div>
        </center>
        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Nit</td>
                    <td>Nombre Empresa</td>
                    <td>Titular</td>
                    <td>Numero Contacto</td>
                    <td>Correo</td>
                    <td>Direccion</td>
                    <td>Estado</td>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td><a href="{{ url('proveedor/editar/' . $item->Nit) }}"><button class="btn btn-primary"><i
                                        class="fa-solid fa-pen"></i></button></a></td>
                        <td>{{ $item->Nit }}</td>
                        <td>{{ $item->NombreEmpresa }}</td>
                        <td> {{ $item->Titular }} </td>
                        <td> {{ $item->NumeroContacto }} </td>
                        <td> {{ $item->Correo }} </td>
                        <td> {{ $item->Direccion }} </td>
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
            <button class="btn btn-success col-3" onclick="switchadicion2('proveedoradicion')">Nuevo Proveedor <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>

        {{-- Creacion de productos --}}

        <div id="proveedoradicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Nuevo Proveedor</h4>
                <hr>

                <form action={{ url('proveedor/crear') }} method="post"> @csrf

                    <label for="Nit" class="form-label">Nit</label>
                    <input type="text" class="form-control" name="Nit" value="{{ old('Nit') }}">
                    @error('Nit')
                        <div>
                            @foreach ($errors->get('Nit') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="NombreEmpresa" class="form-label">NombreEmpresa</label>
                    <input type="text" class="form-control" name="NombreEmpresa" value="{{ old('NombreEmpresa') }}">
                    @error('Nit')
                        <div>
                            @foreach ($errors->get('NombreEmpresa') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <div class="row">
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
                            <label for="NumeroContacto" class="form-label">NumeroContacto</label>
                            <input type="text" class="form-control" name="NumeroContacto" value=" {{ old('NumeroContacto') }} ">
                            @error('NumeroContacto')
                                <div>
                                    @foreach ($errors->get('NumeroContacto') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>

                    <label for="Correo" class="form-label">Correo</label>
                    <input type="text" class="form-control" name="Correo" value=" {{ old('Correo') }} ">
                    @error('Correo')
                        <div>
                            @foreach ($errors->get('Correo') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="Direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="Direccion" value=" {{ old('Direccion') }} ">
                    @error('Direccion')
                        <div>
                            @foreach ($errors->get('Direccion') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <br>
                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <button type="button" class="btn btn-primary btn-danger"
                        onclick="switchadicion2('proveedoradicion')">Cancelar</i></button>

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
@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush