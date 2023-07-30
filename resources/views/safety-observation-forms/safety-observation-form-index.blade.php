@extends('layouts.app')

@section('content')
@pushOnce('head-scripts')
<script>
    let lastVisibleTable = 'so-approved-table'; // Tabel awal yang ditampilkan (ganti sesuai ID tabel pertama yang ingin ditampilkan)

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
@endPushOnce
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Laporan Safety Observation</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2 class="card-title">Laporan Safety Observation</h2>
                                <div class="btn-group btn-group-sm" role="group" aria-label="">
                                    <button type="button" class="btn btn-primary" id="approved-table" onclick="toggle('so-approved-table')">Diterima</button>
                                    <button type="button" class="btn btn-primary" id="pending-review-table" onclick="toggle('so-pending-review-table')">Sedang di Review</button>
                                    <button type="button" class="btn btn-primary" id="pending-approve-table" onclick="toggle('so-pending-approve-table')">Sedang ditinjau Manager</button>
                                    <button type="button" class="btn btn-primary" id="rejected-table" onclick="toggle('so-rejected-table')">Ditolak</button>
                                </div>
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="{{ route('safety-observation-forms.create') }}" class="btn btn-primary">
                                Lapor Temuan Baru</a>
                            </div>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                    </div>
                    <div class="card-body" id="so-approved-table">
                        @include('safety-observation-forms.safety-observation-form-approved')
                    </div>
                    <div class="card-body" id="so-pending-review-table" hidden>
                        @include('safety-observation-forms.safety-observation-form-pending-review')
                    </div>
                    <div class="card-body" id="so-pending-approve-table" hidden>
                        @include('safety-observation-forms.safety-observation-form-pending-approve')
                    </div>
                    <div class="card-body" id="so-rejected-table" hidden>
                        @include('safety-observation-forms.safety-observation-form-rejected')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @pushOnce('body-scripts')
    <script>
        let toggle = () => {
           let element = document.getElementById('mydiv');
           element.toggleAttribute('hidden');
        }
    </script>
    @endPushOnce
@endsection
