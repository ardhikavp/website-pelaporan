@extends('layouts.dashboard')

@section('content')
@pushOnce('head-scripts')
<style>
    /* Add custom CSS for button size */
    .btn-group.btn-group-sm .btn {
      font-size: 12px; /* Adjust the font size as needed */
      padding: 0.1rem 0.2rem; /* Adjust the padding as needed */
    }

    @media (max-width: 576px) {
      /* Customize button size for small screens */
      .btn-group.btn-group-sm .btn {
        font-size: 12px; /* Adjust the font size as needed */
        padding: 0.1rem 0.2rem; /* Adjust the padding as needed */
      }
    }
    .btn-group-sm .btn-primary {
            background-color: #71a3b8;
            border: 1px solid rgba(90, 126, 164, 0.5);
            border-radius: 5px;
            margin: 5px;
            color: #000000;
        }
  </style>
@endPushOnce
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
                        <a href="{{ route('notifications.notification') }}">Notification</a>
                    </div>
                    <div class="row">
                        <div class="btn-group btn-group-sm d-flex" role="group" aria-label="">
                            <button type="button" class="btn btn-primary" onclick="showCanvas('barChart')"><strong> Laporan Safety Observation Tiap Lokasi</strong></button>
                            <button type="button" class="btn btn-primary" onclick="showCanvas('ucLineChart')"><strong>Grafik Laporan Safety Observation</strong></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <canvas id="pieChart" width="50%" height="50%"></canvas>
                    </div>
                    <div class="col-md-12">
                        <canvas id="barChart" width="50%" height="30%" style="display: block;"></canvas>
                    </div>
                    <div>
                        <canvas id="ucLineChart" width="50%" height="30%" style="display: none;"></canvas>
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
    }
}
</script>
    @endPushOnce
@endsection
