@extends('layouts.dashboard')

@section('content')
@pushOnce('head-scripts')
<script>
    let lastVisibleTable = 'keberhasilan-laporan'; // Tabel awal yang ditampilkan (ganti sesuai ID tabel pertama yang ingin ditampilkan)

    function toggle(tableId) {
        const targetTable = document.getElementById(tableId);
        const lastTable = document.getElementById(lastVisibleTable);

        if (targetTable && lastTable) {
            if (targetTable.hidden) {
                targetTable.hidden = false;
                lastTable.hidden = true;
                lastVisibleTable = tableId;
            }
        }
    }
</script>
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
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .btn-group-sm .btn-primary {
            background-color: #71a3b8;
            border: 1px solid rgba(90, 126, 164, 0.5);
            border-radius: 5px;
            margin: 5px;
            color: #000000;
        }
    </style>
    <style>
        /* Custom styles for the modal */
        .custom-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 50%;
            height: 50%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
        }

        .custom-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 2px solid #007bff;
            border-radius: 10px;
            padding: 20px;
            max-width: 50%;
            max-height: 50%;
            overflow: auto;
        }

        .custom-modal .modal-dialog {
        max-width: 40%;
        max-height: 40%;
    }

        .custom-modal h1 {
            font-size: 1.5rem;
        }
    </style>
@endPushOnce
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Riwayat Laporan Safety Observation</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Riwayat Safety Observation</h3>
                        </div>
                        <div class="btn-group btn-group-sm d-flex" role="group" aria-label="">
                            <button type="button" class="btn btn-primary" id="keberhasilan-laporan-button" onclick="toggle('keberhasilan-laporan')"><strong> Keberhasilan laporan </strong></button>
                            <button type="button" class="btn btn-primary" id="laporan-tiap-perusahaan-button" onclick="toggle('laporan-tiap-perusahaan')"><strong> Pelaporan Tiap Perusahaan </strong></button>
                        </div>
                    </div>
                </div>
                <div class="card" id="keberhasilan-laporan">
                    <div class="card-header">
                        <h1>Keberhasilan Laporan Safety Observation</h1>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead></thead>
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
                <div class="card" id="laporan-tiap-perusahaan" hidden>
                    <div class="card-header">
                        <h1 class="text-center">Jumlah Laporan Diterima Setiap Perusahaan</h1>
                        <div class="card-body">
                            @foreach ($companies as $company)
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <div style="font-size: 24px;">
                                        Perusahaan {{ $company->company }} (Jumlah Laporan : {{ $totalApprovedForms[$company->company] ?? 0 }})
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50%">Nama Pegawai</th>
                                                        <th style="width: 50%">Jumlah Laporan Disetujui</th>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@pushOnce('body-scripts')
<script>
    // Fungsi untuk menangani tampilan/sembunyi modal
    document.addEventListener('DOMContentLoaded', function () {
        var modalCloseButtons = document.querySelectorAll('.modal .btn-close');
        modalCloseButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var modal = button.closest('.modal');
                var fotoModal = bootstrap.Modal.getInstance(modal);
                fotoModal.hide();
            });
        });
    });
</script>
@endPushOnce
@endsection
