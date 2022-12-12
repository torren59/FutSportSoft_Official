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

            <h1>Editar deportista</h1>
            @foreach ($deportistaData as $item)
                <form action=" {{ url('deportista/actualizar/' . $item->Documento) }} " method="post"> @csrf
                    <div class="col-12">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="Nombre"
                        @if ($errors->any()) 
                        value = "{{ old('Nombre') }}"
                        @else
                        value="{{ $item->Nombre }}" @endif>
                        @error('Nombre')
                            <div>
                                @foreach ($errors->get('Nombre') as $errorNombre)
                                    <small> {{ $errorNombre }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="Documento" class="form-label">Documento</label>
                        <input readonly type="number" class="form-control" name="Documento" value="{{ $item->Documento }}">
                    </div>


                    <div class="row">
                        <div class="col-4">
                            <label for="FechaNacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="FechaNacimiento"
                                @if ($errors->any()) value = "{{ old('FechaNacimiento') }}"
                        @else
                        value="{{ $item->FechaNacimiento }}" @endif>
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
                            <input type="number" class="form-control" name="Celular"
                                @if ($errors->any()) value = "{{ old('Celular') }}"
                        @else
                        value="{{ $item->Celular }}" @endif>
                            @error('Celular')
                                <div>
                                    @foreach ($errors->get('Celular') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="Direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="Direccion"
                                @if ($errors->any()) value = "{{ old('Direccion') }}"
                        @else
                        value="{{ $item->Direccion }}" @endif>
                            @error('Direccion')
                                <div>
                                    @foreach ($errors->get('Direccion') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="Correo" class="form-label">Correo</label>
                        <input type="text" class="form-control" name="Correo"
                            @if ($errors->any()) value = "{{ old('Correo') }}"
                    @else
                    value="{{ $item->Correo }}" @endif>
                        @error('Correo')
                            <div>
                                @foreach ($errors->get('Correo') as $errorCorreo)
                                    <small> {{ $errorCorreo }} </small>
                                @endforeach
                            </div>
                        @enderror
                    </div>

                    @php
                        $newAccTabSt = '';
                        $choiceAccTabSt = '';
                        
                        if ($errors->any() && !$errors->has('howAcc')) {
                            if (old('howAcc') == 'newAccTab') {
                                $newAccTabSt = 'checked';
                            } elseif (old('howAcc') == 'choiceAccTab') {
                                $choiceAccTabSt = 'checked';
                            }
                        }
                    @endphp

                    <div class="row" style="margin-top:12%; display:flex; justify-content:flex-start;">
                        <div class="form-check col-4">
                            <input class="form-check-input" type="radio" name="howAcc" value="newAccTab"
                                onclick="hideAccTab2()" {{ $newAccTabSt }}>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Nuevo acudiente
                            </label>
                        </div>

                        <div class="form-check col-4">
                            <input class="form-check-input" type="radio" name="howAcc" value="choiceAccTab"
                                onclick="hideAccTab2()" {{ $choiceAccTabSt }}>
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
                        $choiceAccTabCl = 'oneOptionHide';
                        
                        if ($errors->any() && !$errors->has('howAcc')) {
                            if (old('howAcc') == 'newAccTab') {
                                $newAccTabCl = 'oneOptionShow';
                            } elseif (old('howAcc') == 'choiceAccTab') {
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
                                        @foreach ($TipoDocAcc as $item)
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
                                    <input type="number" class="form-control" name="DocumentoAcc"
                                        value="{{ old('DocumentoAcc') }}">
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
                                    <input type="number" class="form-control" name="CelularAcc"
                                        value="{{ old('CelularAcc') }}">
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
                                    <input type="text" class="form-control" name="CorreoAcc"
                                        value="{{ old('CorreoAcc') }}">
                                    @error('CorreoAcc')
                                        <div>
                                            @foreach ($errors->get('CorreoAcc') as $item)
                                                <small> {{ $item }} </small>
                                            @endforeach
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-success">
                                    Guardar
                                </button>
                            </div>
                        </div>

                        {{-- LISTADO DE ACUDIENTES --}}
                        <div class="{{ $choiceAccTabCl }}" id="choiceAccTab">
                            <div class="col-12">
                                <label for="CurrentDocumentoAcc" class="form-label">Seleccionar acudiente</label>
                                @error('CurrentDocumentoAcc')
                                    <div>
                                        @foreach ($errors->get('CurrentDocumentoAcc') as $item)
                                            <small> {{ $item }} </small>
                                        @endforeach
                                    </div>
                                @enderror
                                <select class="form-select" name="CurrentDocumentoAcc">
                                    @foreach ($Acudientes as $Acudiente)
                                        <option value="{{ $Acudiente->DocumentoAcudiente }}">
                                            {{ $Acudiente->NombreAcudiente }}- {{ $Acudiente->DocumentoAcudiente }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-success">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                </form>
            @endforeach

        </div>
    </div>
@endsection

@push('scripts')
    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src=" {{ asset('./js/Programacion/deportista.js') }} "></script>
    <script src=" {{ asset('./js/Programacion/categorias.js') }} "></script>
@endpush
