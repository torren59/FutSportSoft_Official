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
            <div class="col-12" style="display:flex;justify-content:flex-start;position:fixed;top:6%;">
                <a href=" {{ url('deportista/listar') }} ">
                    <button class="btn btn-outline-danger">
                        <i class="fa-sharp fa-solid fa-arrow-left"></i> Cancelar
                    </button>
                </a>
            </div>

            <h1>Nuevo deportista</h1>

            <form action=" {{ url('deportista/upData') }} " method="post"> @csrf
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
                        <input type="date" class="form-control" name="FechaNacimiento"
                            value="{{ old('FechaNacimiento') }}">
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
                </div>

                @php
                    $newAccTabSt = '';
                    $noAccTabSt = '';
                    $choiceAccTabSt = '';

                    if ($errors->any() && !$errors->has('howAcc')) {
                        if (old('howAcc') == 'newAccTab') {
                            $newAccTabSt = 'checked';
                        }
                        else if (old('howAcc') == 'noAccTab') {
                            $noAccTabSt = 'checked';
                        }
                        else if (old('howAcc') == 'choiceAccTab') {
                            $choiceAccTabSt = 'checked';
                        }
                    }
                @endphp

                <div class="row" style="margin-top:12%; display:flex; justify-content:flex-start;">
                    <div class="form-check col-4">
                        <input class="form-check-input" type="radio" name="howAcc" value="newAccTab"
                            onclick="hideAccTab()"  {{$newAccTabSt}}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Nuevo acudiente
                        </label>
                    </div>

                    <div class="form-check col-4">
                        <input class="form-check-input" type="radio" name="howAcc" value="noAccTab"
                            onclick="hideAccTab()"  {{$noAccTabSt}} >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Sin acudiente
                        </label>
                    </div>

                    <div class="form-check col-4">
                        <input class="form-check-input" type="radio" name="howAcc" value="choiceAccTab"
                            onclick="hideAccTab()"  {{$choiceAccTabSt}} >
                        <label class="form-check-label" for="flexRadioDefault3">
                            Seleccionar acudiente
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    @error('howAcc')
                        <div>
                            @foreach ($errors->get('howAcc') as $errorHowAcc)
                                <small> {{ $errorHowAcc }} </small>
                            @endforeach
                        </div>
                    @enderror
                </div>

                <hr>

                @php
                    $newAccTabCl = 'oneOptionHide';
                    $noAccTabCl = 'oneOptionHide';
                    $choiceAccTabCl = 'oneOptionHide';

                    if ($errors->any() && !$errors->has('howAcc')) {
                        if (old('howAcc') == 'newAccTab') {
                            $newAccTabCl = 'oneOptionShow';
                        }
                        else if (old('howAcc') == 'noAccTab') {
                            $noAccTabCl = 'oneOptionShow';
                        }
                        else if (old('howAcc') == 'choiceAccTab') {
                            $choiceAccTabCl = 'oneOptionShow';
                        }
                    }
                @endphp

                <div class="accZone">
                    {{-- NUEVO ACUDIENTE --}}
                    <div class="{{ $newAccTabCl }} " id="newAccTab">
                        <h1>Nuevo acudiente</h1>
                        <div class="row">
                            <div class="col-6">
                                <label for="TipoDocumentoAcc" class="form-label">Tipo de documento</label>
                                <select class="form-select" name="TipoDocumentoAcc">
                                    <option value="" selected>Selecione un tipo de documento</option>
                                    @foreach ($TiposDoc as $item)
                                        <option value="{{ $item->TipoDocumento }}">{{ $item->Descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('TipoDocumentoAcc')
                                    <div>
                                        @foreach ($errors->get('TipoDocumentoAcc') as $item)
                                            <small> {{ $item }} </small>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>
        
                            <div class="col-6">
                                <label for="DocumentoAcc" class="form-label">Documento</label>
                                <input type="number" class="form-control" name="DocumentoAcc" value="{{ old('DocumentoAcc') }}">
                                @error('DocumentoAcc')
                                    <div>
                                        @foreach ($errors->get('DocumentoAcc') as $item)
                                            <small> {{ $item }} </small>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="NombreAcc" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="NombreAcc" value="{{ old('NombreAcc') }}">
                            @error('NombreAcc')
                                <div>
                                    @foreach ($errors->get('NombreAcc') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="CelularAcc" class="form-label">Celular</label>
                                <input type="number" class="form-control" name="CelularAcc" value="{{ old('CelularAcc') }}">
                                @error('CelularAcc')
                                    <div>
                                        @foreach ($errors->get('CelularAcc') as $item)
                                            <small> {{ $item }} </small>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="CorreoAcc" class="form-label">Correo</label>
                                <input type="number" class="form-control" name="CorreoAcc" value="{{ old('CorreoAcc') }}">
                                @error('CorreoAcc')
                                    <div>
                                        @foreach ($errors->get('CorreoAcc') as $item)
                                            <small> {{ $item }} </small>
                                        @endforeach
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- ENVIAR SIN ACUDIENTE --}}
                    <div class="{{ $noAccTabCl }}" id="noAccTab">
                        <div>
                            <button type="submit" class="btn btn-success" >
                                Guardar
                            </button>
                        </div>
                    </div>
                    {{-- LISTADO DE ACUDIENTES --}}
                    <div class="{{ $choiceAccTabCl }}" id="choiceAccTab">

                    </div>
                </div>
                <br>
                <br>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/Programacion/deportista.js') }} "></script>
    <script src=" {{ asset('./js/Programacion/categorias.js') }} "></script>
@endpush
