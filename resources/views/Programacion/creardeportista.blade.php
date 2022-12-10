@extends('../layouts/home')



@section('title', 'Nuevo Deportista')

@push('styles')
    {{-- Csrf para funcionamiento de Ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <div class="floatmodal" style="width: 50%;">
        <div class="floatcontent" style="height: 70vh">
            <div class="col-12" style="display:flex;justify-content:flex-start">
                <a href=" {{url('deportista/listar')}} ">
                    <button class="btn btn-outline-danger">
                        <i class="fa-sharp fa-solid fa-arrow-left"></i> Cancelar
                    </button>
                </a>
            </div>
            <h1>Nuevo deportista</h1>

            <form action=" {{url('deportista/upData')}} " method="post"> @csrf
                <div class="col-12">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="Nombre" value="{{ old('Nombre') }}">
                    @error('Nombre')
                        <div>
                            @foreach ($errors->get('Nombre') as $errorNombre)
                                <small> {{ $errorNombre }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>
    
                <div class="row">
                    <div class="col-6">
                        <label for="TipoDocumento" class="form-label">Tipo de documento</label>
                        <select class="form-select" name="TipoDocumento"> 
                            <option value="" selected>Selecione un tipo de documento</option>
                            @foreach ($TiposDoc as $item)
                                <option value="{{ $item->TipoDocumento }}">{{ $item->Descripcion }}</option>
                            @endforeach
                        </select>
                        @error('TipoDocumento')
                            <div>
                                @foreach ($errors->get('TipoDocumento') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
    
                    <div class="col-6">
                        <label for="Documento" class="form-label">Documento</label>
                        <input type="number" class="form-control" name="Documento" value="{{ old('Documento') }}">
                        @error('Documento')
                            <div>
                                @foreach ($errors->get('Documento') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-4">
                        <label for="FechaNacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" name="FechaNacimiento" value="{{ old('FechaNacimiento') }}">
                        @error('FechaNacimiento')
                            <div>
                                @foreach ($errors->get('FechaNacimiento') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
    
                    <div class="col-4">
                        <label for="Celular" class="form-label">Celular</label>
                        <input type="number" class="form-control" name="Celular" value="{{ old('Celular') }}">
                        @error('Celular')
                            <div>
                                @foreach ($errors->get('Celular') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
    
                    <div class="col-4">
                        <label for="Dirección" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="Direccion" value="{{ old('Direccion') }}">
                        @error('Direccion')
                            <div>
                                @foreach ($errors->get('Direccion') as $item)
                                    <small> {{ $item }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>
    
                    <div class="row" style="margin-top:12%">
                        <div class="col-4">
                                <button type="submit" class="btn btn-success" name="newAcc">
                                    Nuevo acudiete
                                </button>
                        </div>
                        <div class="col-4">
                            <a href="{{url('deportista/upData/2')}}">
                                <button class="btn btn-warning">
                                    Guardar sin acudiente
                                </button>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{url('deportista/upData/3')}}">
                                <button class="btn btn-success">
                                    Seleccionar acudiente
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection

@push('scripts')
    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/Programacion/categorias.js') }} "></script>
@endpush
