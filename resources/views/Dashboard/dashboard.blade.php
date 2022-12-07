@extends('../layouts/home')

@push('styles')
    {{-- Csrf para funcionamiento de Ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{ asset('./css/layouts/datatable.css') }} ">
    <link rel="stylesheet" href="{{ asset('./css/layouts/cruds.css') }} ">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    <div class="service_list">
        <div class="grid_triple_center">
            <div class="grid_span_2a3">

                <div class="container">
                    <div class="row justify-content-center p-5">
                        <div class="card2 col-12 shadow-lg p-3 mb-5 bg-white rounded">
                            <center>
                                <h1><i>Inscritos a través del tiempo</i></h1>
                            </center>
                            <div class=" row justify-content-center">
                                <div class="col-2">
                                    <h3>Desde</h3>
                                    <select type="number" name="inferiorMonth" id="inferiorMonth" class="form-select">
                                        <option value="1">Enero</option>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($ofertedMonths as $month)
                                            <option value="{{ $i }}"> {{ $month }} </option>
                                            @php
                                                $i += 1;
                                            @endphp
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2">
                                    <h3>-></h3>
                                    <select type="number" name="inferiorYear" id="inferiorYear" class="form-select">
                                        <option value=" {{ $currentYear }} "> {{ $currentYear }} </option>
                                        @foreach ($ofertedYears as $year)
                                            <option value=" {{ $year }} "> {{ $year }} </option>
                                        @endforeach
                                    </select>
                                </div>




                                <div class="col-2">
                                    <h3>Hasta</h3>
                                    <select type="number" name="superiorMonth" id="superiorMonth" class="form-select">
                                        <option value="{{ $currentMonth }}"> {{ $currentMonthName }}</option>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($ofertedMonths as $month)
                                            <option value="{{ $i }}"> {{ $month }} </option>
                                            @php
                                                $i += 1;
                                            @endphp
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2">
                                    <h3>-></h3>
                                    <select type="number" name="superiorYear" id="superiorYear" class="form-select">
                                        <option value="{{ $currentYear }}"> {{ $currentYear }} </option>
                                        @foreach ($ofertedYears as $year)
                                            <option value=" {{ $year }} "> {{ $year }} </option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-2">
                                    <h3 style="text-align:left">Opciones</h3>
                                    <button class="btn btn-outline-primary" id="queryButton" onclick="setNewInterval()"
                                        type="button">Consultar</button>

                                </div>
                            </div>
                            <div class="col-12 p-5" style="width:70%;margin-left:15%">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src=" {{ asset('./js/Programacion/dashboard.js') }} "></script>
@endpush
