@extends('../layouts/home')

@section('title', 'Seguridad')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <div class="floatmodal" style="width: 400px; height:250px;">
        <div class="floatcontent">

            <h4>Cambiando clave de {{ $User->Nombre }} </h4>
            <form action=" {{ url('usuario/changepassword') }} " method="post"> @csrf
                <input hidden type="text" value=" {{ $User->id }} " name="id">
                <label for="password" class="form-label">Nueva clave</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                <div>
                    @foreach ($errors->get('password') as $item)
                        <small> {{ $item }} </small>
                    @endforeach
                </div>
                @enderror
                <br>
                <div class="row">

                    <div class="col-5">
                        <button type="submit" class="btn btn-outline-success">Aceptar</button>
                    </div>

                    <div class="col-5">
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
