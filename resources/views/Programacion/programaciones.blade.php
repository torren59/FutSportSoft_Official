@extends('../layouts/home')



@section('title', 'Programación')

@push('styles')
{{-- Estilos propios --}}
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">

    {{-- sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    {{-- Listado --}}
    @php
        $programaciones = $progData['programaciones'];
    @endphp

    <div class="service_list">
        <center>
            <div class="tituloTabla">
                <h1>PROGRAMACION</h1>
            </div>
            <br>
            <div class="addbtn">
                <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('programacionadicion')">Nueva Programación <i
                        class="fa-solid fa-circle-plus"></i></button>
            </div>
        </center>

        <table id="tabla">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Sede</td>
                    <td>Grupo</td>
                    <td>Horario</td>
                    <td>Fecha Inicio</td>
                    <td>Fecha FInalización</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($programaciones as $item)
                <tr>
                    <td> {{$item->ProgramacionId}} </td>
                    <td> {{$item->NombreSede}} </td>
                    <td> {{$item->NombreGrupo}} </td>
                    <td> {{$item->Horario}} </td>
                    <td> {{$item->FechaInicio}} </td>
                    <td> {{$item->FechaFinalizacion}} </td>
                </tr>
                @endforeach
            </tbody>
        </table>





        {{-- Creacion de sedes --}}

        <div id="programacionadicion" class="adicion_off" style="width:700px;height:400px">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Nueva Programacion</h4>
                <hr>

                <form action={{ url('programacion/crear') }} method="post"> @csrf

                    @php
                        $sedes = $progData['sedes'];
                        $deportes = $progData['deportes'];
                        $horarios = $progData['horarios'];
                    @endphp

                    {{-- Retorna Valores a los input si hubo algún error --}}
                    @if ($errors->any())
                        <script>
                            push_categorias({{ old('DeporteId') }}, {{ old('CategoriaId') }});
                        </script>
                    @endif


                    <div class="row">
                        <div class="col-4">
                            <label for="DeporteId" class="form-label">Deporte</label>
                            <select name="DeporteId" class="form-select deporte_select">
                                <option value="">Selecciona Deporte</option>
                                @foreach ($deportes as $item)
                                    <option value=' {{ $item->DeporteId }} '>{{ $item->NombreDeporte }}</option>
                                @endforeach
                            </select>
                            @error('DeporteId')
                                <div>
                                    @foreach ($errors->get('DeporteId') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="CategoriaId" class="form-label">Categoria</label>
                            <select name="CategoriaId" class="form-select categoria_select">
                                <option value="">Selecciona categoría</option>
                                {{-- @foreach ($categorias as $item)
                                    <option value=' {{ $item->SedeId }} '>{{ $item->NombreSede }}</option>
                                @endforeach --}}
                            </select>
                            @error('CategoriaId')
                                <div>
                                    @foreach ($errors->get('CategoriaId') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="GrupoId" class="form-label">Grupo</label>
                            <select name="GrupoId" class="form-select grupo_select">
                                <option value="">Selecciona grupo</option>
                                {{-- @foreach ($grupos as $item)
                                    <option value=' {{ $item->GrupoId }} '>{{ $item->NombreGrupo }}</option>
                                @endforeach --}}
                            </select>
                            @error('GrupoId')
                                <div>
                                    @foreach ($errors->get('GrupoId') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>


                    <label for="SedeId" class="form-label">Sede</label>
                    <select name="SedeId" class="form-select">
                        <option value="">Selecciona sede</option>

                        @foreach ($sedes as $item)
                            <option value=' {{ $item->SedeId }} '>{{ $item->NombreSede }}</option>
                        @endforeach

                    </select>
                    @error('SedeId')
                        <div>
                            @foreach ($errors->get('SedeId') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="HorarioId" class="form-label">Horario</label>
                    <select name="HorarioId" class="form-select">
                        <option value="">Selecciona Horario</option>

                        @foreach ($horarios as $item)
                            <option value=' {{ $item->HorarioId }} '>{{ $item->NombreHorario }} {{ $item->Horario }}
                            </option>
                        @endforeach

                    </select>
                    @error('HorarioId')
                        <div>
                            @foreach ($errors->get('HorarioId') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="FechaInicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" name="FechaInicio">
                    @error('FechaInicio')
                        <div>
                            @foreach ($errors->get('FechaInicio') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="FechaFinalizacion" class="form-label">Fecha de Finalización</label>
                    <input type="date" name="FechaFinalizacion" class="form-control">
                    @error('FechaFinalizacion')
                        <div>
                            @foreach ($errors->get('FechaFinalizacion') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <br>

                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <button type="button" class="btn btn-primary btn-danger"
                        onclick="switchadicion2('programacionadicion')">Cancelar</i></button>

                </form>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('programacionadicion');
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
    <script src=" {{ asset('./js/layouts/asincronas.js') }} "></script>
@endpush
