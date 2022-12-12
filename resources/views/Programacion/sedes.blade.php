@extends('../layouts/home')

@section('title', 'Sedes')

@push('styles')
    {{-- Csrf para funcionamiento de Ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Estilos propios --}}
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">

    {{-- sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    {{-- Listado --}}

    <div class="service_list">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de sedes</h1>
            </div>
        </center>

        @if (in_array(125, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('sedeadicion')">Nueva Sede <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>SedeId</td>
                    <td>Nombre</td>
                    <td>Municipio</td>
                    <td>Barrio</td>
                    <td>Direccion</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td>
                            @if (in_array(137, $permisos))
                                <a href="{{ url('sede/editar/' . $item->SedeId) }}"><button class="btn btn-outline-primary"><i
                                            class="fa-solid fa-pen"></i></button></a>
                            @endif
                        </td>
                        <td>{{ $item->SedeId }}</td>
                        <td>{{ $item->NombreSede }}</td>
                        <td> {{ $item->Municipio }} </td>
                        <td> {{ $item->Barrio }} </td>
                        <td> {{ $item->Direccion }} </td>
                        <td>
                            @if (in_array(149, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="check_{{ $item->SedeId }}" {{ $checkstate }}
                                        onclick="tryChange('{{ $item->SedeId }}', 'errorsEstado')">
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>



        {{-- Creacion de sedes --}}

        <div id="sedeadicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h2>Nueva Sede</h2>


                <form action={{ url('sede/crear') }} method="post"> @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="NombreSede" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="NombreSede" value="{{ old('NombreSede') }}">
                            @error('NombreSede')
                                <div>
                                    @foreach ($errors->get('NombreSede') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="Municipio" class="form-label">Municipio</label>
                            <input type="text" class="form-control" name="Municipio" value=" {{ old('Municipio') }} ">
                            @error('Municipio')
                                <div>
                                    @foreach ($errors->get('Municipio') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="Barrio" class="form-label">Barrio</label>
                            <input type="text" class="form-control" name="Barrio" value=" {{ old('Barrio') }} ">
                            @error('Barrio')
                                <div>
                                    @foreach ($errors->get('Barrio') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="Direccion" class="form-label">Direccion</label>
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
                    <div class="botonessedes p-5">
                        <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="switchadicion2('sedeadicion')">Cancelar</i></button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Alerta cambio de estado --}}
        <div class="adicion_off" id="errorsEstado" style="width:550px">
            <div class="floatcontent">
                <h2>Operación cancelada</h2>
                <div>
                    <h4>* No fue posible realizar el cambio de estado. <br>
                    Esta sede está vinculada a programaciones activas.</h4>
                </div>
                <div id="errorsEstadoMsg">
                    {{-- Acá se imprimen las programaciones vinculadas --}}
                </div>

                <div class="botonalerta p-3">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="alterModal('errorsEstado')">Cancelar</i></button> <br>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('sedeadicion');
                }, 500);
            </script>
        @endif

        {{-- Mensajes personalizados --}}
        @if (isset($sweet_setAll))
            <script>
                setTimeout(() => {
                    swal_setAll("{{ $sweet_setAll['title'] }}", "{{ $sweet_setAll['msg'] }}",
                        "{{ $sweet_setAll['type'] }}");
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
    <script src=" {{ asset('./js/Programacion/sedes.js') }} "></script>
@endpush
