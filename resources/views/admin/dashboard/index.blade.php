@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">Website Views</p>
                    <div
                        class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $data }}</h3>
                        <i class="ti-eye icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                    <p class="mb-0 mt-2 text-info">views</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">Website Views Today</p>
                    <div
                        class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $viewToday }}</h3>
                        <i class="ti-eye icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                    <p class="mb-0 mt-2 text-info">views</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title text-md-center text-xl-left">Your Post</p>
                    <div
                        class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $post }}</h3>
                        <i class="ti-write icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                    </div>
                    <p class="mb-0 mt-2 text-info">post</p>
                    {{-- <p class="mb-0 mt-2 text-danger">0.12% <span class="text-black ms-1"><small>(30 days)</small></span></p> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if (auth()->user()->role == 'admin')
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Count Chart</h4>
                        <canvas id="doughnutChart"></canvas>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">IP Address Access Chart</h4>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="mb-4">
            <form id="monthForm" method="GET" action="{{ route('dashboard') }}">
                <div class="row">
                    <div class="col-lg-4">
                        <label class="mb-2" for="month">Pilih Bulan:</label>
                        <select class="form-select" name="month" id="month"
                            onchange="document.getElementById('monthForm').submit();">
                            @foreach ($months as $month)
                                <option value="{{ $month['value'] }}" {{ $selectedMonth == $month['value'] ? 'selected' : '' }}>
                                    {{ $month['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label class="mb-2" for="year">Pilih Tahun:</label>
                        <select class="form-select form-select" name="year" id="year"
                            onchange="document.getElementById('monthForm').submit();">
                            @for ($y = 2020; $y <= now()->year; $y++)
                                <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daily IP Address Access Chart</h4>
                    <canvas id="viewsChart" width="400" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $.ajax({
            url: '/getDataUserForChart',
            type: 'GET',
            success: function(response) {
                var adminCount = response.adminCount;
                var userCount = response.userCount;

                var doughnutPieData = {
                    datasets: [{
                        data: [adminCount, userCount],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        'Admin',
                        'User',
                    ]
                };

                var doughnutChartCanvas = document.getElementById("doughnutChart");
                var doughnutChart = new Chart(doughnutChartCanvas, {
                    type: 'doughnut',
                    data: doughnutPieData
                });
            }
        });
        $.ajax({
            url: '/getIpAddressDataForChart',
            type: 'GET',
            success: function(response) {
                var ipLabels = [];
                var ipData = [];

                response.forEach(function(data) {
                    ipLabels.push(data.ipaddress);
                    ipData.push(data.total);
                });

                var barChartData = {
                    labels: ipLabels,
                    datasets: [{
                        label: 'Number of Accesses',
                        data: ipData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                };

                var barChartCanvas = document.getElementById("barChart");
                var barChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
        var ctx = document.getElementById('viewsChart').getContext('2d');
        var viewsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($days),
                datasets: [{
                    label: 'Jumlah Views per Hari',
                    data: @json($chartData),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
