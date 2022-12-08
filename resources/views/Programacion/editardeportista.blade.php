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
                <div class="col-6">
                    <label for="Documento" class="form-label">Documento</label>
                    <input type="number" class="form-control" name="Documento" 
                    @if ($errors->any())
                    value = {{old('Documento')}}
                    @else
                    value={{$item->Documento}}
                    @endif>                    
                    @error('Documento')
                        <div>
                            @foreach ($errors->get('Documento') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="DocumentoAcudiente" class="form-label">Documento Acudiente</label>
                    <input type="number" class="form-control" name="DocumentoAcudiente" value="{{ old('DocumentoAcudiente', $item->DocumentoAcudiente) }}">
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
                    <input type="text" class="form-control" name="TipoDocumento" value="{{ old('TipoDocumento', $item->TipoDocumento) }}">
                    @error('TipoDocumento')
                        <div>
                            @foreach ($errors->get('TipoDocumento') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="Nombre" 
                    @if ($errors->any())
                    value = {{old('Nombre')}}
                    @else
                    value={{$item->Nombre}}
                    @endif>                    
                    @error('Nombre')
                        <div>
                            @foreach ($errors->get('Nombre') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="FechaNacimiento" class="form-label">Fecha Nacimiento</label>
                    <input type="date" class="form-control" name="FechaNacimiento" 
                     @if ($errors->any())
                    value = {{old('FechaNacimiento')}}
                    @else
                    value={{$item->FechaNacimiento}}
                    @endif>
                    @error('FechaNacimiento')
                        <div>
                            @foreach ($errors->get('FechaNacimiento') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="Direccion" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="Direccion" 
                     @if ($errors->any())
                    value = {{old('Direccion')}}
                    @else
                    value={{$item->Direccion}}
                    @endif>
                    @error('Direccion')
                        <div>
                            @foreach ($errors->get('Direccion') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="Celular" class="form-label">Celular</label>
                    <input type="number" class="form-control" name="Celular" 
                     @if ($errors->any())
                    value = {{old('Celular')}}
                    @else
                    value={{$item->Celular}}
                    @endif>
                    @error('Celular')
                        <div>
                            @foreach ($errors->get('Celular') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="Correo" class="form-label">Correo</label>
                    <input type="mail" class="form-control" name="Correo" 
                     @if ($errors->any())
                    value = {{old('Correo')}}
                    @else
                    value={{$item->Correo}}
                    @endif>
                    @error('Correo')
                        <div>
                            @foreach ($errors->get('Correo') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="UltimoPago" class="form-label">Ultimo Pago</label>
                    <input type="date" class="form-control" name="UltimoPago" 
                     @if ($errors->any())
                    value = {{old('UltimoPago')}}
                    @else
                    value={{$item->UltimoPago}}
                    @endif>
                    @error('UltimoPago')
                        <div>
                            @foreach ($errors->get('UltimoPago') as $item)
                                <small> {{ $item }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>

                

   
            @endforeach

            <div class="col-6">
                <button type="submit" class="btn btn-primary btn-success">Guardar</i></button>
                <a href=" {{ url('proveedor/listar') }} "><button type="button"
                        class="btn btn-primary btn-danger">Cancelar</i></button></a>
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