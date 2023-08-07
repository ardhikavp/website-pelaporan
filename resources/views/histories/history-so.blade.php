@extends('layouts.dashboard')


@section('content')
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
    <h1>Approved Safety Observation Form History</h1>

    <div class="card">
        <div class="card-body">
            @foreach ($companies as $company)
            <div>
                Company {{ $company->company }} (Jumlah Laporan : {{ $totalApprovedForms[$company->company] ?? 0 }})
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Pegawai</th>
                        <th>Jumlah Laporan Disetujui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($approvedFormsCounts->where('company', $company->company) as $count)
                        <tr>
                            <td>{{ $count->name }}</td>
                            <td>{{ $count->approved_forms_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        </div>
    </div>
@endsection
