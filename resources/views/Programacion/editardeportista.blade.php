@extends('../layouts/home')



@section('title', 'Editar deportista')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

    @foreach ($deportistadata as $item)
    <form action={{ url('deportista/actualizar/'.$item->Documento ) }} method="post">
    @endforeach

        @csrf
        <div class="grid_triple_center">
            <div class="grid_span_2a3">

                <div class="adicion_title">
                    <h1>Editar Deportista</h1>
                </div>


                @foreach ($deportistadata as $item)
                    <div class="adicion_content" id="addsed">
                        <div class="mb-3  col-5">
                            <label class="form-label">Documento Acudiente</label>
                            <input type="text" class="form-control" name="DocumentoAcudiente"
                                value=" {{ old('DocumentoAcudiente', $item->DocumentoAcudiente) }} ">
                                @error('DocumentoAcudiente')
                                <div>
                                    @foreach ($errors->get('DocumentoAcudiente') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3  col-5">
                            <label class="form-label">Tipo Documento</label>
                            <input type="number" class="form-control" name="TipoDocumento"
                                value=" {{ old('TipoDocumento') }} ">
                                @error('TipoDocumento')
                                <div>
                                    @foreach ($errors->get('TipoDocumento') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3  col-5">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="Nombre"
                                value="{{ old('Nombre',$item->Nombre) }}">
                                @error('Nombre')
                                <div>
                                    @foreach ($errors->get('Nombre') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3  col-5">
                            <label class="form-label">Fecha De Nacimiento</label>
                            <input type="text" class="form-control" name="FechaNacimiento"
                                value=" {{ old('FechaNacimiento', $item->FechaNacimiento) }} ">
                                @error('FechaNacimiento')
                                <div>
                                    @foreach ($errors->get('FechaNacimiento') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3  col-5">
                            <label class="form-label">Direccion</label>
                            <input type="text" class="form-control" name="Direccion"
                                value=" {{ old('Direccion', $item->Direccion) }} ">
                                @error('Direccion')
                                <div>
                                    @foreach ($errors->get('Direccion') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3  col-5">
                            <label class="form-label">Celular</label>
                            <input type="text" class="form-control" name="Celular"
                                value="{{ old('Celular', $item->Celular) }}">
                                @error('Celular')
                                <div>
                                    @foreach ($errors->get('Celular') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3  col-5">
                            <label class="form-label">Correo</label>
                            <input type="text" class="form-control" name="Correo"
                                value=" {{ old('Correo', $item->Correo) }} ">
                                @error('Correo')
                                <div>
                                    @foreach ($errors->get('Correo') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3  col-5">
                            <label class="form-label">Ultimo Pago</label>
                            <input type="date" class="form-control" name="UltimoPago"
                                value="{{ old('UltimoPago', $item->UltimoPago) }}">
                                @error('UltumoPago')
                                <div>
                                    @foreach ($errors->get('UltimoPago') as $item)
                                        <small> {{$item}} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                    </div>
                @endforeach

                <div class="mb-3 col-7">
                    <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                    <a href=" {{url('deportista/listar')}} "><button type="button" class="btn btn-primary btn-danger">Cancelar</i></button></a>
                </div>
            </div>
        </div>

    </form>

@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush