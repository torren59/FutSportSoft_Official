@extends('../layouts/home')



@section('title', 'Ayudas')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/ayudas.css') }} ">
@endpush

@section('content')
    <center>
        <h1>Gestión de ayudas</h1>
    </center>

    <div class="container">
        <div class="row p-2">

            <div class="row justify-content-between p-2">

                <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                    <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    <div class="body text-center">
                        <h1 class="title">Gestión de acceso</h1>
                    </div>

                </div>

                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de Dashboard</h1>
                        </div>

                    </div>

                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de roles</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de Usuarios</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de proveedores</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de compras</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de productos</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de horarios</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de sedes</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de deportes</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de categorías</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de grupos</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de deportistas</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de programación</h1>
                        </div>

                    </div>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 18rem;border:0;">
                        <iframe src="https://www.youtube-nocookie.com/embed/TiM_TFpT_DE?start=8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="body text-center">
                            <h1 class="title">Gestión de ventas</h1>
                        </div>

                    </div>

            </div>

        </div>
    </div>






















@endsection
