@extends('../layouts/home')



@section('title', 'Ayudas')

@push('styles')
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    {{-- Listado --}}

    <div class="service_list">
        <center>
            <div class="tituloTabla">
                <h1>AYUDAS</h1>
            </div>
        </center>


        <table id="tabla">
            <thead>
                <tr>
                    <td>AyudaId</td>
                    <td>NombreAyuda</td>
                    <td>Enlace</td>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        <td>{{ $item->AyudaId }}</td>
                        <td>{{ $item->NombreAyuda }}</td>
                        <td> {{ $item->Enlace }} </td>


                    </tr>
                @endforeach
            </tbody>
        </table>

@endsection


@push('scripts')
    <script>
        let tabla = document.getElementById("tabla");
        let datatable = new DataTable(tabla);
    </script>

    <script src=" {{ asset('./js/layouts/cruds.js') }} "></script>
@endpush