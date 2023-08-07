@extends('layouts.dashboard')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Riwayat Laporan Safety Behavior Checklist</li>
        </ol>
    </nav>
    {{-- <div class="row"> --}}
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Riwayat Safety Behavior Checklist</h1>
                <div class="card-body">
                    @foreach ($companies as $company)
                    <div class="card" style="margin-block-end: 10pt">
                        <div class="card-header"><h2>{{ $company->company }}</h2>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="30%">Nomor Laporan</th>
                                        <th style="35%">Nama Pekerjaan</th>
                                        <th style="35%">Safety Index</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approvedAnswers->where('company_id', $company->id) as $answer)
                                            <tr>
                                                <td>{{ $answer->nomor_laporan }}</td>
                                                <td>{{ $answer->operation_name }}</td>
                                                <td>{{ $answer->safety_index }}(%)</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        <div class="col-md-12">
        </div>
    {{-- </div> --}}
</div>
@endsection

