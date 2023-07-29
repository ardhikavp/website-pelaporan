@extends('layouts.app')

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
                </div>
                <div class="row"></div>
                    <div class="col-md-6">
                        <canvas id="pieChart" width="50%" height="50%"></canvas>
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
                                <canvas id="chart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div >
            <div class="card">
                <div class="card-header"><h1>Laporan</h1>
                    <div class="card-body">
                        <table class="table table-bordered">
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
                                @foreach($data as $item)
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
    </div>
</div>
@pushOnce('body-scripts')
<script>
    var chartData = @json($chartData);
</script>
<script>
    // Get the data from PHP and convert it into separate arrays for labels and data
    const labels = {!! json_encode($safetyObservationsPerLocation->pluck('location')) !!};
    const data = {!! json_encode($safetyObservationsPerLocation->pluck('total')) !!};

    // Create a new bar chart
    const ctx = document.getElementById('chart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Safety Observations',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the bar color
                borderColor: 'rgba(75, 192, 192, 1)', // Customize the border color
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Start the y-axis from 0
                }
            }
        }
    });
</script>
@endPushOnce

@endsection
