@extends('../layouts/home')

@section('title', 'Roles')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
@endpush

@section('content')




    <div class="service_list" id="listadorol">
        <center>
            <div class="tituloTabla">
                <h1>Gestión de Roles</h1>
            </div>
        </center>
        <br>
        <div class="addbtn">
            <button class="btn btn-outline-secondary col-2" onclick="switchadicion2('roladicion')">Crear <i
                    class="fa-solid fa-circle-plus"></i></button>
        </div>
        <table id="tabla">
            <thead>
                <tr>
                    <td>Acción</td>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Estado</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td><abbr title="Editar"><a href="{{ url('roles/editar/' . $item->RolId) }}"><button
                                        class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></button></a></abbr>

                            <abbr title="Detalles"><a href="{{ url('roles/detalle/' . $item->RolId) }}"><button
                                        class="btn btn-outline-secondary"><i
                                            class="fa-solid fa-circle-info"></i></button></a></abbr>
                        </td>
                        <td>{{ $item->RolId }}</td>
                        <td>{{ $item->NombreRol }}</td>

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
                                    {{ $checkstate }}>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>




        {{-- Creacion de roles --}}

        <div id="roladicion" class="adicion_off" style="width:600px;height:400px">
            <div class="floatcontent">
                <h1 style="padding-top:5%;">Nuevo Rol</h1>
                <hr>

                <form action={{ url('roles/crear') }} method="post"> @csrf

                    <label for="NombreRol" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="NombreRol" value="{{ old('NombreRol') }}">
                    @error('NombreRol')
                        <div>
                            @foreach ($errors->get('NombreRol') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror

                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Seleciona</th>
                            <th scope="col">Permiso</th>
                            <th scope="col">Descripción</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                                    <label class="custom-control-label" for="customCheck1">1</label>
                                </div>
                              </td>
                              <td>permiso1</td>
                              <td>permite visualizar la lista de roles</td>

                            </tr>
                            <tr>
                              <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">2</label>
                                </div>
                              </td>
                              <td>Bootstrap Grid 4 Tutorial and Examples</td>
                              <td>Cristina</td>

                            </tr>
                            <tr>
                              <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">3</label>
                                </div>
                              </td>
                              <td>Bootstrap Flexbox Tutorial and Examples</td>
                              <td>Cristina</td>

                            </tr>
                          </tbody>
                      </table>


                    <br>
                    <button type="submit" class="btn btn-outline-primary">Guardar</i></button>
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="switchadicion2('roladicion')">Cancelar</i></button>

                </form>

            </div>



        </div>


    </div>

    @if ($errors->any())
        <script>
            setTimeout(() => {
                switchadicion2('roladicion');
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
