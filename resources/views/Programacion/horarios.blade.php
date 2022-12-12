@extends('../layouts/home')



@section('title', 'Horarios')

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
                <h1>Gestión de horarios</h1>
            </div>
        </center>



        @if (in_array(124, $permisos))
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('horarioadicion')">Nuevo Horario <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        @endif

        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>Horario Id</td>
                    <td>Nombre</td>
                    <td>Inicia</td>
                    <td>Finaliza</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td>
                            @if (in_array(136, $permisos))
                                <a href="{{ url('horario/editar/' . $item->HorarioId) }}"><button
                                        class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></button></a>
                            @endif
                        </td>
                        <td>{{ $item->HorarioId }}</td>
                        <td>{{ $item->NombreHorario }}</td>
                        <td> {{ $item->HoraInicio }} </td>
                        <td> {{ $item->HoraFinalizacion }} </td>
                        <td>
                            @if (in_array(148, $permisos))
                                {{-- Definiendo estado --}}
                                @php
                                    $checkstate = '';
                                    if ($item->Estado == true) {
                                        $checkstate = 'checked';
                                    }
                                @endphp

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="check_{{ $item->HorarioId }}" {{ $checkstate }}
                                        onclick="tryChange('{{ $item->HorarioId }}', 'errorsEstado')">

                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>





        {{-- Creacion de Horarios --}}

        <div id="horarioadicion" class="adicion_off" style="width:500px;height:300px">
            <div class="floatcontent">
                <h2>Nuevo Horario</h2>


                <form action={{ url('horario/crear') }} method="post"> @csrf

                    <label for="NombreHorario" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="NombreHorario" value="{{ old('NombreHorario') }}">
                    @error('NombreHorario')
                        <div>
                            @foreach ($errors->get('NombreHorario') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="Horario" class="form-label">Horario</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="time" class="form-control" name="HoraInicio"
                                value="{{ old('HoraInicio') }}">
                            @error('HoraInicio')
                                <div>
                                    @foreach ($errors->get('HoraInicio') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <input type="time" class="form-control" name="HoraFinalizacion"
                            value="{{ old('HoraFinalizacion') }}">
                            @error('HoraFinalizacion')
                                <div>
                                    @foreach ($errors->get('HoraFinalizacion') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="botoneshorarios p-5">
                            <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="switchadicion2('horarioadicion')">Cancelar</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Alerta cambio de estado --}}
        <div class="adicion_off" id="errorsEstado" style="width:550px">
            <div class="floatcontent">
                <h2>Operación cancelada</h2>
                <div>
                   <h4> * No fue posible realizar el cambio de estado. <br>
                    Este horario está vinculada a programaciones activas.</h4>
                </div>
                <div id="errorsEstadoMsg">
                    {{-- Acá se imprimen las programaciones vinculadas --}}
                </div>
                <div class="botoneshorarios p-3">
                <button type="button" class="btn btn-outline-secondary"
                    onclick="alterModal('errorsEstado')">Cancelar</i></button> <br>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('horarioadicion');
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
    <script src=" {{ asset('./js/Programacion/horarios.js') }} "></script>
@endpush
