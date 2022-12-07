<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/layouts/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/cruds.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Escuela de fútbol Alejo</title>
</head>

<body>
    <div id="background-container-mainsite">
        <div class="contenido" style="height:100%">
            <div class="floatmodal" style="width:30%;height:40%">
                <div class="floatcontent">
                    <div class="p-5">
                        <h3>Ingrese su correo</h3>
                        <small>* Recuerda que debe ser el correo con el cual accedes a tu perfil</small>
                    </div>
                    <form action=" {{ url('acceso/enviamail') }} " method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" value=" {{ old('email') }} ">

                                @error('email')
                                    @foreach ($errors->get('email') as $item)
                                        <div class="error_subtitle">
                                            {{ $item }}
                                        </div>
                                    @endforeach
                                @enderror

                            </div>
                        </div>


                        <div class="botnesrecuperarpassword p-5">
                            <button type="submit" class="btn btn-outline-primary">Recuperar</button>
                            <a href=" {{ url('/') }} "><button type="button" class="btn btn-outline-secondary">Volver al
                                    login</button></a>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src=" {{ asset('js/layouts/cruds.js') }} "></script>
</body>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background-image: url("../../img/layouts/login2.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        background-attachment: fixed;


    }
</style>

</html>
