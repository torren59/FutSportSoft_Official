@extends('../layouts/home')

@push('styles')
    {{-- Csrf para funcionamiento de Ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    <div class="service_list">
        <div class="grid_triple_center">
            <div class="grid_span_2a3">
                <div class="grid_doble_simetrico" style="height: auto; padding-top:4%;">
                    <div class="row">
                        <center><h3>    <i>Inscritos a través del tiempo</i></h3></center>
                        <br>
                        <div class="col-5 row">
                            <h3>Desde</h3>
                            <div class="col-6">
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

                            <div class="col-6">
                                <select type="number" name="inferiorYear" id="inferiorYear" class="form-select">
                                    <option value=" {{$currentYear}} "> {{$currentYear}} </option>
                                    @foreach ($ofertedYears as $year)
                                        <option value=" {{$year}} "> {{ $year }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-5 row">
                            <h3>Hasta</h3>
                            <div class="col-6">
                                <select type="number" name="superiorMonth" id="superiorMonth" class="form-select">
                                    <option value="{{$currentMonth}}"> {{$currentMonthName}}</option>
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

                            <div class="col-6">
                                <select type="number" name="superiorYear" id="superiorYear" class="form-select">
                                    <option value="{{ $currentYear }}"> {{ $currentYear }} </option>
                                    @foreach ($ofertedYears as $year)
                                        <option value=" {{ $year }} "> {{ $year }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-2">
                            <h3>Opciones</h3>
                            <div>
                                <button class="btn btn-success" id="queryButton" onclick="setNewInterval()" type="button">Consultar intervalo</button>
                            </div>
                        </div>
                        <div class="col-12" style="width:70%;margin-left:15%">
                            <canvas id="myChart"></canvas>
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
