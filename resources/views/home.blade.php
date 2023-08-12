@extends('layouts.dashboard')

@section('content')
@pushOnce('head-scripts')
<style>
    /* Add custom CSS for button size */
    .btn-group.btn-group-sm .btn {
        font-size: 12px;
        padding: 0.1rem 0.2rem;
        /* Add styles for the active button */
        background-color: #71a3b8;
        color: white;
        border: 1px solid rgba(90, 126, 164, 0.5);
    }

    @media (max-width: 576px) {
        /* Customize button size for small screens */
        .btn-group.btn-group-sm .btn {
            font-size: 12px;
            padding: 0.01rem 0.02rem;
        }
    }

    .btn-group-sm .btn-primary {
        background-color: #71a3b8;
        border: 1px solid rgba(90, 126, 164, 0.5);
        border-radius: 5px;
        margin: 5px;
        color: #000000;
    }

    /* Add styles for the active button */
    .btn-group-sm .btn-primary[aria-current="page"] {
        background-color: #35495e;
        color: white;
        border: 1px solid rgba(53, 73, 94, 0.5);
    }


.btn-primary:hover {
    background-color: blue;
    color: white;
    outline: 1px solid blue;
}
    .canvas-responsive {
        max-width: 100%;
        max-height: 400px;
        /* Optional: Add some padding to prevent the chart from being cut off */
        padding: 10px;
    }
  </style>
@endPushOnce
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        {{-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }} --}}
                        {{-- <a href="{{ route('notifications.notification') }}">Notification</a> --}}
                    </div>
                    <div class="row">
                        <div class="btn-group btn-group-sm d-flex" role="group" aria-label="">
                            <button type="button" class="btn btn-primary" onclick="showCanvas('openClosedChart')" ><strong> Data Progress Laporan Safety Observation</strong></button>
                            <button type="button" class="btn btn-primary" onclick="showCanvas('barChart')"><strong> Laporan Safety Observation Tiap Lokasi</strong></button>
                            <button type="button" class="btn btn-primary" onclick="showCanvas('ucLineChart')"><strong>Grafik Laporan Safety Observation</strong></button>
                            <button type="button" class="btn btn-primary" onclick="showCanvas('openObservationsChart')"><strong>Tipe Laporan Safety Observation Dalam Progress</strong></button>
                            <button type="button" class="btn btn-primary" onclick="showCanvas('closedObservationsChart')"><strong>Tipe Laporan Safety Observation Telah Selesai</strong></button>
                        </div>
                    </div>
                    <div class="col-md-12 wrapper">
                        <canvas id="barChart" class="canvas-responsive" width="500px" height="600px" style="display: none;"></canvas>
                    </div>
                    <div >
                        <canvas id="ucLineChart" class="canvas-responsive" width="500px" height="600px" style="display: none;"></canvas>
                    </div>
                    <div>
                        <canvas id="openClosedChart" class="canvas-responsive" width="500px" height="600px" style="display: block;"></canvas>
                    </div>
                    <div>
                        <!-- Open Observations by Type Chart -->
                        <canvas id="openObservationsChart" class="canvas-responsive" width="500px" height="600px" style="display: none;"></canvas>
                    </div>
                    <div>
                        <!-- Closed Observations by Type Chart -->
                        <canvas id="closedObservationsChart" class="canvas-responsive" width="500px" height="600px" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
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

            // Hapus atribut aria-current dari semua tombol
            var allButtons = document.querySelectorAll('.btn-group-sm .btn');
            allButtons.forEach(function(button) {
                button.removeAttribute('aria-current');
            });

            // Tambahkan atribut aria-current="page" pada tombol yang sedang aktif
            var activeButton = document.querySelector(`[onclick="showCanvas('${canvasId}')"]`);
            if (activeButton) {
                activeButton.setAttribute('aria-current', 'page');
            }
        }
    }
</script>

<script>
    // Open vs Closed Chart
    new Chart(document.getElementById('openClosedChart'), {
        type: 'doughnut',
        data: {
            labels: ['Open', 'Closed'],
            datasets: [{
                data: [{{ $openCount }}, {{ $closedCount }}],
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(75, 192, 192)'],
                hoverOffset: 4
            }]
        }
    });

    // Open Observations by Type Chart
    new Chart(document.getElementById('openObservationsChart'), {
        type: 'doughnut',
        data: {
            labels: ['Unsafe Action', 'Unsafe Condition', 'Bad Housekeeping'],
            datasets: [{
                data: [{{ $unsafeActionCount }}, {{ $unsafeConditionCount }}, {{ $badHousekeepingCount }}],
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
                hoverOffset: 4
            }]
        }
    });

    // Closed Observations by Type Chart
    new Chart(document.getElementById('closedObservationsChart'), {
        type: 'doughnut',
        data: {
            labels: ['Unsafe Action', 'Unsafe Condition', 'Bad Housekeeping'],
            datasets: [{
                data: [{{ $closedUnsafeActionCount }}, {{ $closedUnsafeConditionCount }}, {{ $closedBadHousekeepingCount }}],
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
                hoverOffset: 4
            }]
        }
    });
</script>
    @endPushOnce
@endsection
