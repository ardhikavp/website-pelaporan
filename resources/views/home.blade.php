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
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="container mt-4">
        </div>
    </div>
</div>
<script>
    var chartData = @json($chartData);
</script>
@endsection
