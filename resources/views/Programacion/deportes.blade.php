@extends('../layouts/home')



@section('title', 'Deportes')

@push('styles')
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
            <div class="tituloTabla">
                <h1>Deportes</h1>
            </div>
        </center>
        <br>

        <div class="addbtn">
            <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('deporteadicion')">Nuevo Deporte <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>

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
                        <td><a href="{{ url('deporte/editar/' . $item->DeporteId) }}"><button class="btn btn-primary"><i
                                        class="fa-solid fa-pen"></i></button></a></td>
                        <td>{{ $item->DeporteId }}</td>
                        <td>{{ $item->NombreDeporte }}</td>
                        <td>
                            {{-- Definiendo estado --}}
                            @php
                                $checkstate = '';
                                if ($item->Estado == true) {
                                    $checkstate = 'checked';
                                }
                            @endphp

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="{{ $item->DeporteId }}state"
                                    onclick="changeState('{{ $item->NombreDeporte }}', {{ $item->DeporteId }})"
                                    {{ $checkstate }}>
                            </div>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>

        {{-- Creacion de deportes --}}

        <div id="deporteadicion" class="adicion_off" style="width:600px;height:300px">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Nuevo Deporte</h4>
                <hr>

                <form action={{ url('sede/crear') }} method="post"> @csrf

                    <label for="NombreSede" class="form-label">Nombre deporte</label>
                    <input type="text" class="form-control" name="NombreDeporte" value="{{ old('NombreDeporte') }}">
                    @error('NombreDeporte')
                        <div>
                            @foreach ($errors->get('NombreDeporte') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <br>
                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <button type="button" class="btn btn-primary btn-danger"
                        onclick="switchadicion2('deporteadicion')">Cancelar</i></button>

                </form>
            </div>
        </div>


        {{-- Creacion de deportes --}}
        {{-- <div class="adicion adicion_off" id="roladicion">
            <form action={{ url('deporte/crear') }} method="post">

                @csrf
                <div class="adicion_title">
                    <h1>Nuevo Deporte</h1>
                </div>


                <div class="adicion_content" id="addsed">

                    <div class="mb-3  col-5">
                        <label class="form-label">Nombre Deporte</label>
                        <input type="text" class="form-control" name="NombreDeporte">
                    </div>

                </div>
                <div class="mb-3 col-7">
                    <button type="submit" class="btn btn-primary btn-success"
                        onclick="switchadicion('roladicion')">Guardar</i></button>
                    <button type="button" class="btn btn-primary btn-danger"
                        onclick="switchadicion('roladicion')">Cancelar</i></button>
                </div>

            </form>
        </div> --}}



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

    </div>

@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush
