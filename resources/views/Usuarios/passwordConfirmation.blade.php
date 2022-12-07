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



        <!--Inicio zona de contenido-->

        <div class="main_area">
            <div class="zonaalta">
                <div class="h1Access">
                    <h1>FutSportSoft</h1>
                </div>
            </div>
            <div class="contenido p-5">
                <div class="row justify-content-center">
                    <div class="card col-4 text-align-center">
                        <div class="p-2">
                            <center>
                                <h1>Se ha enviado un correo de recuperación a {{ $email }} </h1>
                                <small>* Recuerda revisar en la bandeja principal y la bandeja de no deseados</small>
                            </center>
                        </div>
                    </div>
                    <script src=" {{ asset('js/layouts/home.js') }} "></script>
                    <script src=" {{ asset('js/layouts/cruds.js') }} "></script>
                </div>
            </div>
        </div>


    </div>

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
