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
            <div class="grid_triple_center">
                <div class="grid_span_2a3">
                    <h1>FutSportSoft</h1>
                    <p> Hola {{ $User->Nombre }} </p>
                    <p>Para restablecer tu contraseña ingresa al siguiente enlace</p>
                    <p><a href=" {{ $Url }} ">Restablecer contraseña</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
