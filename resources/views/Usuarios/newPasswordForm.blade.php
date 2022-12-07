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
            <div class="contenido">
                <br>
                <div>
                    <div class="floatmodal" style="width:500px;height:400px">
                        <div class="floatcontent">
                            <h1>Restablecimiento de contraseña</h1>
                            <form action=" {{url('acceso/setnuevaclave')}} " method="post"> @csrf

                                <input  hidden type="text" name="token"
                                @if ($errors->any()) value = "{{ old('token') }}"
                                @else
                                value = " {{ $Info['Token'] }} "
                                @endif>

                                <input  hidden type="text" name="email"
                                @if ($errors->any()) value = "{{ old('email') }}"
                                @else
                                value = " {{ $Info['email'] }} "
                                @endif>

                                <label for="nuevaclave" class="form-label">Nueva clave</label>
                                <input type="text" name="nuevaclave" class="form-control"
                                value=" {{ old('nuevaclave') }} ">

                                <label for="confirmacion" class="form-label">Confirmación</label>
                                <input type="text" name="confirmacion" class="form-control"
                                value=" {{ old('confirmacion') }} ">

                                @error('confirmacion')
                                    @foreach ($errors->get('confirmacion') as $item)
                                        <small> {{ $item }} </small>
                                    @endforeach
                                @enderror

                                <br>
                                <button type="submit" class="btn btn-outline-primary">Guardar</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

</body>

</html>
