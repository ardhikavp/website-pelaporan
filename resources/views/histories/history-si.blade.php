
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Riwayat Safety Index Perusahaan</li>
        </ol>
    </nav>
    {{-- <div class="row"> --}}
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Riwayat Safety Index</h3>
                <div class="card-body">
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                        <tr>
                                            <th>Nama Perusahaan</th>
                                            <th>Rata-rata Safety Index</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accumulatedSafetyIndex as $data)
                                        <tr>
                                            <td>{{ $data['company'] }}</td>
                                            <td>{{ $data['average_safety_index'] }}(%)</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    {{-- </div> --}}
</div>
@endsection

