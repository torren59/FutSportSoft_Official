<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/home.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('styles')
    <title> @yield('title') </title>
</head>

<body>

    <div id="background-container-mainsite">
        <div id="megacontainer">
            <div id="sidevar" class="sidevaroff">
                <div class="grid-sidevar">
                    <div class="main-sidevar-title">
                        <div id="backrow" onclick="sidevar()">
                            <- </div>
                                <div id="logo">
                                    <h3><img src=" {{ asset('img/layouts/logo.png') }} " alt="Logo academia de fútbol">
                                    </h3>
                                </div>
                        </div>
                        <div class="main-sidevar-area">

                            <div class="main-sidevar-item" id="seg_configuracion">
                                <button type="button" class="btn col-12 sidevar-btn-title btn-outline-light"
                                    onclick="items('configuracion')">
                                    CONFIGURACIÓN
                                </button>
                                <div class="main-sidevar-item-links-off" id="configuracion">
                                    <a href={{ url('roles/listar') }}><button class="btn col-12 btn-outline-light"
                                        id="seg_servdep_roles" name="sended" value="7">Roles</button></a>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_usuario">
                                <button type="button" class="btn col-12 sidevar-btn-title btn-outline-light"
                                    onclick="items('usuario')">
                                    USUARIOS
                                </button>
                                <div class="main-sidevar-item-links-off" id="usuario">
                                    <a href={{ url('usuario/listar') }}><button class="btn col-12 btn-outline-light"
                                        id="seg_servdep_usuario" name="sended" value="7">Gestión de
                                        usuarios</button></a>
                                    <button type="submit" class="btn col-12 btn-outline-light" value="3">Gestión de
                                        acceso</button>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_compras">
                                <button type="button" class="btn col-12 sidevar-btn-title btn-outline-light"
                                    onclick="items('compras')">
                                    COMPRAS
                                </button>
                                <div class="main-sidevar-item-links-off" id="compras">
                                    <button type="submit" class="btn col-12 btn-outline-light" id="seg_compras_prov"
                                        value="4">Proveedores</button>
                                    <button type="submit" class="btn col-12 btn-outline-light" value="5">Gestión de
                                        compras</button>
                                    <button type="submit" class="btn col-12 btn-outline-light" value="6">Gestión de
                                        productos</button>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_servdep">
                                <button type="button" class="btn col-12 sidevar-btn-title btn-outline-light"
                                    onclick="items('servdeportivos')">
                                    PROGRAMACIÓN
                                </button>
                                <div class="main-sidevar-item-links-off" id="servdeportivos">

                                    <a href={{ url('horario/listar') }}><button class="btn col-12 btn-outline-light"
                                            id="seg_servdep_sedes" value="7">Horarios</button></a>

                                    <a href={{ url('sede/listar') }}><button class="btn col-12 btn-outline-light" id="seg_servdep_sedes"
                                            value="7">Sedes</button></a>

                                    <a href={{ url('deporte/listar') }}><button class="btn col-12 btn-outline-light"
                                            id="seg_servdep_deportes" value="8">Gestión de
                                            deportes</button></a>

                                    <button class="btn col-12 btn-outline-light" id="seg_servdep_categorias" value="9">Gestión de
                                        categorías</button>

                                    <button class="btn col-12 btn-outline-light" value="10">Gestión de
                                        grupos</button>

                                    <a href={{ url('deportista/listar') }}><button class="btn col-12 btn-outline-light"
                                            id="seg_servdep_sedes" value="7">Gestión de
                                            deporitstas</button></a>

                                    <a href=" {{ url('programacion/listar') }} "><button class="btn col-12 btn-outline-light">Gestión de
                                            programación</button></a>

                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_venta">
                                <button type="button" class="btn col-12 sidevar-btn-title btn-outline-light"
                                    onclick="items('ventas')">
                                    VENTAS
                                </button>
                                <div class="main-sidevar-item-links-off" id="ventas">
                                    <a href=" {{ url('venta/listar') }} "><button class="btn col-12 btn-outline-light"
                                            value="12">Gestión de ventas</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="main-sidevar-area" id="logout">
                            <a href="./login.php"><button type="button" class=" btn  btn-outline-dark">Cerrar
                                    sesión</button></a>
                        </div>
                    </div>

                </div>
            </div>
            <!--Fin SideVar-->

            <!--Inicio zona de contenido-->

            <div class="main_area">
                <div class="zonaalta">

                    <div>
                        <button type="button" class="btn btn-dark" onclick="sidevar()"><i
                                class="fa-solid fa-grip-lines"></i></button>
                    </div>

                    <div>
                        <a href={{ url('dashboard/panel') }}><button  class="btn btn-dark"
                                id="seg_dashboard" value="13">Dashboard</i></button></a>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-dark" value="14">Ayuda</button>
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
    </div>

</body>

</html>

