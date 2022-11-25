@extends('../layouts/home')

@section('title', 'Seguridad')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <div class="floatmodal" style="width: 400px; height:450px;">
        <div class="floatcontent">

            <h4>Cambiando clave de {{ $User->Nombre }} </h4>
            <form action=" {{ url('usuario/changepassword') }} " method="post"> @csrf
                <input hidden type="text" value=" {{ $User->id }} " name="id">

                <label for="actual_password" class="form-label">Clave actual</label>
                <input type="text" class="form-control" name="actual_password"
                @if ($errors->any())
                    value = " {{old('actual_password')}} "
                @endif>
                @error('actual_password')
                <div>
                    @foreach ($errors->get('actual_password') as $item)
                        <small> {{ $item }} </small>
                    @endforeach
                </div>
                @enderror

                <label for="password" class="form-label">Nueva clave</label>
                <input type="text" class="form-control" name="password"
                @if ($errors->any())
                value = " {{old('password')}} "
                @endif>

                <label for="confirmacion" class="form-label">Confirmación nueva clave</label>
                <input type="text" class="form-control" name="confirmacion"
                @if ($errors->any())
                value = " {{old('confirmacion')}} "
                @endif>
                @error('password')
                <div>
                    @foreach ($errors->get('password') as $item)
                        <small> {{ $item }} </small>
                    @endforeach
                </div>
                @enderror
                <br>
                <div class="row">

                    <div class="col-6">
                        <button type="submit" class="btn btn-outline-success">Aceptar</button>
                    </div>

                    <div class="col-6">
                        <a href=" {{ url('usuario/listar') }} ">
                            <button type="button" class="btn btn-outline-danger">Cancelar</button>
                        </a>
                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
