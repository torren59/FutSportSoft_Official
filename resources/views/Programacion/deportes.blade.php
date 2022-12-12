@extends('../layouts/home')



@section('title', 'Deportes')

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


    {{-- class="service_list" --}}

    <div class="service_list">
        <center>

            <h1> Gestión de deportes</h1>

        </center>


        @if (in_array(130, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('deporteadicion')">Nuevo Deporte <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Deporte Id</td>
                    <td>Nombre</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($listado as $item)
                    <tr>
                        <td>
                            @if (in_array(141, $permisos))
                                <a href="{{ url('deporte/editar/' . $item->DeporteId) }}"><button
                                        class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></button></a>
                            @endif
                        </td>
                        <td>{{ $item->DeporteId }}</td>
                        <td>{{ $item->NombreDeporte }}</td>
                        <td>
                            @if (in_array(153, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="check_{{ $item->DeporteId }}" {{ $checkstate }}
                                        onclick="tryChange('{{ $item->DeporteId }}', 'errorsEstado')">
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>

        {{-- Creacion de deportes --}}

        <div id="deporteadicion" class="adicion_off" style="width:600px;height:300px">
            <div class="floatcontent">
                <h1>Nuevo Deporte</h1>

                <form action={{ url('deporte/crear') }} method="post"> @csrf
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <label for="Nombredeporte" class="form-label">Nombre deporte</label>
                            <input type="text" class="form-control" name="NombreDeporte"
                                value="{{ old('NombreDeporte') }}">
                            @error('NombreDeporte')
                                <div>
                                    @foreach ($errors->get('NombreDeporte') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="botonesdeporte p-5">
                        <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="switchadicion2('deporteadicion')">Cancelar</i></button>
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
                    Este deporte está vinculado a categorías activas.</h4>
                </div>
                <div id="errorsEstadoMsg">
                    {{-- Acá se imprimen las programaciones vinculadas --}}
                </div>
                <div class="botonesdeportes p-3">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="alterModal('errorsEstado')">Cancelar</i></button> <br>
                </div>
            </div>
        </div>

        @if ($errors->any())
            @foreach ($errors->get('NombreDeporte') as $item)
                <script>
                    document.onload = Swal.fire({
                        title: 'Operacion cancelada',
                        text: '{{ $item }}',
                        icon: 'warning',
                    });
                </script>
            @endforeach
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
    <script src=" {{ asset('./js/Programacion/deportes.js') }} "></script>
@endpush
