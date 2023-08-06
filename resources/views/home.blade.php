@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                    @if ($notificationData)
                        <div class="alert alert-success">
                            {{ is_array($notificationData['data']) ? $notificationData['data']['data'] : $notificationData['data'] }}
                        </div>
                    @endif
                    </div>
                    <div class="row">
                        <div class="btn-group btn-group-sm d-flex" role="group" aria-label="">
                            <button type="button" class="btn btn-primary" onclick="showCanvas('barChart')"><strong> Laporan Safety Observation Tiap Lokasi</strong></button>
                            <button type="button" class="btn btn-primary" onclick="showCanvas('ucLineChart')"><strong>Laporan Unsafe Condition</strong></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <canvas id="pieChart" width="50%" height="50%"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="barChart" width="50%" height="50%" style="display: block;"></canvas>
                    </div>
                    <div>
                        <canvas id="ucLineChart" style="display: none;"></canvas>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Project Statistics</div>
                        <div class="card-body">
                            <p>Total Companies: {{ $totalCompanies }}</p>
                            <p>Number of Safety Observations in Each Location:</p>
                            <ul>
                                @foreach ($safetyObservationsPerLocation as $observation)
                                    <li>{{ $observation->location }}: {{ $observation->total }}</li>
                                @endforeach
                            </ul>
                            <canvas id="chart-bar" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="card-header">
                    <h1>Laporan</h1>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Bulan</th>
                                    <th>Approved</th>
                                    <th>Rejected</th>
                                    <th>Pending Review</th>
                                    <th>Pending Approval</th>
                                    <th>Kinerja Keberhasilan laporan (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->jumlah_approved }}</td>
                                        <td>{{ $item->jumlah_rejected }}</td>
                                        <td>{{ $item->jumlah_pending_review }}</td>
                                        <td>{{ $item->jumlah_pending_approval }}</td>
                                        <td>{{ $item->hasil_perhitungan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('component.card')
    </div>
    </div>
    @pushOnce('body-scripts')


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var chartData = @json($chartData);
            var configLineGraph = @json($configLineGraph);

            var ctxUC = document.getElementById('ucLineChart').getContext('2d');
            var myChartUC = new Chart(ctxUC, configLineGraph);
        </script>
        <script>
            const labels = {!! json_encode($safetyObservationsPerLocation->pluck('location')) !!};
            const dataPerLocs = {!! json_encode($safetyObservationsPerLocation->pluck('total')) !!};

            document.addEventListener("DOMContentLoaded", function() {
                var ctx = document.getElementById('barChart').getContext('2d');

                // Sample data (replace this with your own data)
                var data = {
                    labels: labels,
                    datasets: [{
                        label: 'Laporan Safety Observation',
                        data: [...dataPerLocs], // Replace this with your data
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Bar fill color
                        borderColor: 'rgba(75, 192, 192, 1)', // Border color
                        borderWidth: 1
                    }]
                };

                var options = {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    // Format the y-axis labels as integers
                                    if (value % 1 === 0) {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                };

                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options
                });
            });
        </script>
<script>
    function showCanvas(canvasId) {
    var allCanvas = document.querySelectorAll('canvas'); // Temukan semua elemen canvas

    // Sembunyikan semua elemen canvas
    allCanvas.forEach(function(canvas) {
        canvas.style.display = 'none';
    });

    // Tampilkan elemen canvas yang sesuai dengan ID yang diberikan
    var targetCanvas = document.getElementById(canvasId);
    if (targetCanvas) {
        targetCanvas.style.display = 'block';
    }
}
</script>
    @endPushOnce
@endsection
