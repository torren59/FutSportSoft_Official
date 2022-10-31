@extends('../layouts/home')



@section('title', 'Deportistas')

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
                <h1>DEPORTISTAS</h1>
            </div>
    </center>

    <div class="addbtn">
        <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('deportistaadicion')">Nuevo Deportista <i
                class="fa-solid fa-circle-plus"></i></button>
    </div>

    <table id="tabla">
        <thead>
            <tr>
                <td>Acción</td>
                <td>Documento</td>
                <td>Documento Acudiente</td>
                <td>Tipo Documento</td>
                <td>Nombre</td>
                <td>Fecha de Nacimiento</td>
                <td>Direccion</td>
                <td>Celular</td>
                <td>Correo</td>
                <td>Estado</td>
                <td>Ultimo pago</td>
            </tr>
        </thead>
        <tbody>
        @foreach ($listado as $item)
                    <tr>
                        <td><a href="{{ url('deportista/editar/'.$item->Documento) }}"><button class="btn btn-primary"><i class="fa-solid fa-pen"></i></button></a></td>
                        <td>{{ $item->Documento }}</td>
                        <td>{{ $item->DocumentoAcudiente }}</td>
                        <td>{{ $item->TipoDocumento }}</td>
                        <td>{{ $item->Nombre }}</td>
                        <td>{{ $item->FechaNacimiento }}</td>
                        <td>{{ $item->Direccion }}</td>
                        <td>{{ $item->Celular }}</td>
                        <td>{{ $item->Correo }}</td>
                        <td>
                            {{-- Definiendo estado --}}
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                    checked>
                            </div>
                            @php
                                $checkstate = '';
                                if ($item->Estado == true) {
                                    $checkstate = 'checked';
                                }
                                
                            @endphp
                        <td>{{ $item->UltimoPago }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>


        {{-- Creacion de productos --}}

        <div id="deportistaadicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h4 style="padding-top:5%;">Nuevo Deportista</h4>
                <hr>

                <form action={{ url('deportista/crear') }} method="post"> @csrf

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
                            <label for="DocumentoAcudiente" class="form-label">Documento Acudiente</label>
                            <input type="text" class="form-control" name="DocumentoAcudiente" value=" {{ old('DocumentoAcudiente') }} ">
                            @error('DocumentoAcudiente')
                                <div>
                                    @foreach ($errors->get('DocumentoAcudiente') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="TipoDocumento" class="form-label">Tipo Documento</label>
                            <input type="text" class="form-control" name="TipoDocumento" value=" {{ old('TipoDocumento') }} ">
                            @error('TipoDocumento')
                                <div>
                                    @foreach ($errors->get('TipoDocumento') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>

                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="Nombre" value=" {{ old('Nombre') }} ">
                    @error('Nombre')
                        <div>
                            @foreach ($errors->get('Nombre') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="FechaNacimiento" class="form-label">FechaNacimiento</label>
                    <input type="date" class="form-control" name="FechaNacimiento" value=" {{ old('FechaNacimiento') }} ">
                    @error('FechaNacimiento')
                        <div>
                            @foreach ($errors->get('FechaNacimiento') as $item)
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

                    <label for="Celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" name="Celular" value=" {{ old('Celular') }} ">
                    @error('Celular')
                        <div>
                            @foreach ($errors->get('Celular') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="Correo" class="form-label">Correo</label>
                    <input type="text" class="form-control" name="Correo" value=" {{ old('Correo') }} ">
                    @error('Correo')
                        <div>
                            @foreach ($errors->get('Correo') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <label for="UltimoPago" class="form-label">UltimoPago</label>
                    <input type="date" class="form-control" name="UltimoPago" value=" {{ old('UltimoPago') }} ">
                    @error('UltimoPago')
                        <div>
                            @foreach ($errors->get('UltimoPago') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <button type="button" class="btn btn-primary btn-danger"
                        onclick="switchadicion2('deportistaadicion')">Cancelar</i></button>

                </form>
            </div>
        </div>

        @if ($errors->any())
            <script>
                setTimeout(() => {
                    switchadicion2('deportistaadicion');
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