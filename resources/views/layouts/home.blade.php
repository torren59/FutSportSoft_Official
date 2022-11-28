<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    {{-- Estilos propios --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/home.css') }} ">

    {{-- Data Table --}}
    <link rel="stylesheet" href=" {{ asset('./css/dataTable/dataTables.min.css') }} ">
    <script src=" {{ asset('./js/dataTable/dataTables.min.js') }} "></script>

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
                                            id="seg_servdep_roles">Roles</button></a>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_usuario">
                                <button type="button" class="btn col-12 sidevar-btn-title btn-outline-light"
                                    onclick="items('usuario')">
                                    USUARIOS
                                </button>
                                <div class="main-sidevar-item-links-off" id="usuario">
                                    <a href={{ url('usuario/listar') }}><button class="btn col-12 btn-outline-light"
                                            id="seg_servdep_usuario">Gestión de
                                            usuarios</button></a>
                                    <button type="submit" class="btn col-12 btn-outline-light" value="3">Gestión
                                        de
                                        acceso</button>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_compras">
                                <button type="button" class="btn col-12 sidevar-btn-title btn-outline-light"
                                    onclick="items('compras')">
                                    COMPRAS
                                </button>
                                <div class="main-sidevar-item-links-off" id="compras">
                                    <a href={{ url('proveedor/listar') }}><button class="btn col-12 btn-outline-light"
                                        id="seg_servdep_compras" >Gestión de
                                    proveedores</button></a>
                                        <a href={{ url('compras/listar') }}><button class="btn col-12 btn-outline-light"
                                            id="seg_servdep_compras" >Gestión de
                                        compras</button></a>
                                        <a href={{ url('producto/listar') }}><button class="btn col-12 btn-outline-light"
                                            id="seg_servdep_compras" >Gestión de
                                        productos</button></a>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_servdep">
                                <button type="button" class="btn col-12 sidevar-btn-title btn-outline-light"
                                    onclick="items('servdeportivos')">
                                    PROGRAMACIÓN
                                </button>
                                <div class="main-sidevar-item-links-off" id="servdeportivos">

                                    <a href={{ url('horario/listar') }}><button
                                            class="btn col-12 btn-outline-light">Gestión de horarios</button></a>

                                    <a href={{ url('sede/listar') }}><button
                                            class="btn col-12 btn-outline-light">Gestión de sedes</button></a>

                                    <a href={{ url('deporte/listar') }}><button
                                            class="btn col-12 btn-outline-light">Gestión de deportes</button></a>

                                    <a href={{ url('categoria/listar') }}><button class="btn col-12 btn-outline-light">
                                            Gestión de categorías</button></a>

                                    <a href={{ url('grupos/listar') }}><button class="btn col-12 btn-outline-light">
                                            Gestión de grupos</button></a>

                                    <a href={{ url('deportista/listar') }}><button class="btn col-12 btn-outline-light"
                                            id="seg_servdep_deportistas">Gestión de
                                            deportistas</button></a>

                                    <a href=" {{ url('programacion/listar') }} "><button
                                            class="btn col-12 btn-outline-light">Gestión de
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
                            <form action="/acceso/salir" method="post"> @csrf
                                <a><button type="submit" class="btn btn-outline-light">Cerrar sesión</button></a>
                            </form>
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
                        <a href={{ url('dashboard/panel') }}><button class="btn btn-dark" id="seg_dashboard"
                                value="13">Dashboard</i></button></a>
                    </div>

                    <div>
                        <a href={{ url('ayudas/listar') }}><button  class="btn btn-dark"
                            id="seg_dashboard" value="13">Ayuda</i></button></a>
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
