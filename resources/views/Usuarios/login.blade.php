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
            <div class="floatmodal" style="width:40%;height:40%">
                <div class="floatcontent">
                    <div>
                        <h1>Ingrese sus credenciales</h1>
                    </div>
                    <form action=" {{ url('acceso/validar') }} " method="post">
                        @csrf
                        <div>
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

                        <div>
                            <label for="password" class="form-label">Clave</label>
                            <input type="password" name="password" class="form-control">

                            @error('password')
                                @foreach ($errors->get(-'password') as $item)
                                    <div class="error_subtitle">
                                        {{ $item }}
                                    </div>
                                @endforeach
                            @enderror

                        </div>
                        <div>
                            <div class="a p-2">
                                <a href=" {{ url('acceso/restablececlave') }} ">He olvidado mi clave</a>
                            </div>
                        </div>
                        <br>
                        <div class="p-2">
                            <button type="submit" class="btn btn-outline-success">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>

            @error('unautorizedAccess')
                @foreach ($errors->get('unautorizedAccess') as $item)
                    <script>
                        setTimeout(() => {
                            swal_warning(" {{ $item }} ");
                        }, 500);
                    </script>
                @endforeach
            @enderror

            @if (isset($sweet_setAll))
                <script>
                    setTimeout(() => {
                        swal_setAll("{{ $sweet_setAll['title'] }}", "{{ $sweet_setAll['msg'] }}",
                            "{{ $sweet_setAll['type'] }}");
                    }, 500);
                </script>
            @endif
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
