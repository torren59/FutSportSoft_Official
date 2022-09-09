<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/home.css') }} ">
    @stack('styles')
    {{-- @vite(['resources/css/layouts/home.css']) --}}
    <title> @yield('title') </title>
</head>

<body>

    <div id="background-container-mainsite">
        <div id="megacontainer">
            <div id="sidevar" class="sidevaroff">
                <div class="grid-sidevar">
                    <div class="main-sidevar-title">
                        <div id="backrow" onclick="sidevar()">
                            <-
                        </div>
                        <div id="logo">
                            <h3><img src=" {{asset('img/layouts/logo.png')}} " alt="Logo academia de fútbol"></h3>
                        </div>
                    </div>
                    <div class="main-sidevar-area">

                            <div class="main-sidevar-item" id="seg_configuracion">
                                <button type="button" class="btn primary-btn col-12 sidevar-btn-title" onclick="items('configuracion')">
                                    CONFIGURACION
                                </button>
                                <div class="main-sidevar-item-links-off" id="configuracion">
                                    <button type="submit" class="btn col-12" name="sended" value="1">Gestion de roles</button>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_usuario">
                                <button type="button" class="btn primary-btn col-12 sidevar-btn-title" onclick="items('usuario')">
                                    USUARIOS
                                </button>
                                <div class="main-sidevar-item-links-off" id="usuario">
                                    <button type="submit" class="btn col-12" name="sended" value="2">Gestion de usuario</button>
                                    <button type="submit" class="btn col-12" name="sended" value="3">Gestion de acceso</button>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_compras">
                                <button type="button" class="btn primary-btn col-12 sidevar-btn-title" onclick="items('compras')">
                                    COMPRAS
                                </button>
                                <div class="main-sidevar-item-links-off" id="compras">
                                    <button type="submit" class="btn col-12" id="seg_compras_prov" name="sended" value="4">Proveedores</button>
                                    <button type="submit" class="btn col-12" name="sended" value="5">Gestion de compras</button>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_existencia">
                                <button type="button" class="btn primary-btn col-12 sidevar-btn-title" onclick="items('existencia')">
                                    EXISTENCIAS
                                </button>
                                <div class="main-sidevar-item-links-off" id="existencia">
                                    <button type="submit" class="btn col-12" name="sended" value="6">Gestion de existencias</button>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_servdep">
                                <button type="button" class="btn primary-btn col-12 sidevar-btn-title" onclick="items('servdeportivos')">
                                    PROGRAMACION
                                </button>
                                <div class="main-sidevar-item-links-off" id="servdeportivos">
                                    <button class="btn col-12" id="seg_servdep_sedes" name="sended" value="7">Sedes</button>
                                    <a href= {{ url('deporte/listar') }} ><button  class="btn col-12" id="seg_servdep_deportes" name="sended" value="8">Gestion de deportes</button></a>
                                    <button  class="btn col-12" id="seg_servdep_categorias" name="sended" value="9">Gestion de categorías</button>
                                    <button  class="btn col-12" name="sended" value="10">Gestion de servicio deportivo</button>
                                    <button  class="btn col-12" name="sended" value="11">Gestion de deporitstas</button>
                                </div>
                            </div>

                            <div class="main-sidevar-item" id="seg_venta">
                                <button type="button" class="btn primary-btn col-12 sidevar-btn-title" onclick="items('ventas')">
                                    VENTAS
                                </button>
                                <div class="main-sidevar-item-links-off" id="ventas">
                                    <button type="submit" class="btn col-12" name="sended" value="12">Gestion de ventas</button>
                                </div>
                            </div>
                    </div>
                    <div class="main-sidevar-area" id="logout">
                        <a href="./login.php"><button type="button" class="btn btn-warning">Cerrar sesión</button></a>
                    </div>
                </div>

            </div>
            <!--Fin SideVar-->
            <!--Inicio zona de contenido-->

            <div class="main_area">
                <div class="zonaalta">
                    <div>
                        <button type="button" class="btn btn-warning" onclick="sidevar()"><i class="fa-solid fa-grip-lines"></i></button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning" id="seg_dashboard" name="sended" value="13">Dashboard</i></button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning" name="sended" value="14">Ayuda</button>

                    </div>
                </div>

                <div class="contenido">

                    @yield('content')

                  <script src=" {{asset('js/layouts/home.js')}} "></script>
                  @stack('scripts')
                    {{-- <script src="../root/servicios/service.js"></script>  --}}
                    <script src="https://kit.fontawesome.com/bd2541fe3a.js" crossorigin="anonymous"></script>
                    

                </div>
            </div>

</body>

</html>