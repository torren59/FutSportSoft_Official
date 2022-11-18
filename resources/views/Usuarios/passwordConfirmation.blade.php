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
                    {{-- <h1>FutSportSoft</h1> --}}
                    FutSportSoft
                </div>
            </div>

            <div class="contenido">

                @yield('content')

                <script src=" {{ asset('js/layouts/home.js') }} "></script>
                <script src=" {{ asset('js/jquery/dist/jquery.js') }} "></script>
                @stack('scripts')
                {{-- <script src="../root/servicios/service.js"></script> --}}
                <script src="https://kit.fontawesome.com/bd2541fe3a.js" crossorigin="anonymous"></script>

            </div>
        </div>


    </div>

</body>

</html>
