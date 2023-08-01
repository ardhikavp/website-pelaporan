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

    document.querySelectorAll('.pagination a').forEach(link => {
    link.addEventListener('click', event => {
      event.preventDefault();
    });
  });
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
  <script>
    // Function to fetch paginated data
    function fetchApprovedTableData(page) {
    $.ajax({
        url: '/approved-table-data?page=' + page,
        method: 'GET',
        success: function (response) {
        updateContent(response);
        },
        error: function (error) {
        console.error('Error fetching paginated data:', error);
        }
    });
    }
    function fetchPendingReviewTableData(page) {
    $.ajax({
        url: '/pending-review-table-data?page=' + page,
        method: 'GET',
        success: function (response) {
        updateContent(response);
        },
        error: function (error) {
        console.error('Error fetching paginated data:', error);
        }
    });
    }
    function fetchPendingApprovedTableData(page) {
    $.ajax({
        url: '/pending-approve-table-data?page=' + page,
        method: 'GET',
        success: function (response) {
        updateContent(response);
        },
        error: function (error) {
        console.error('Error fetching paginated data:', error);
        }
    });
    }
    function fetchRejectedTableData(page) {
    $.ajax({
        url: '/rejected-table-data?page=' + page,
        method: 'GET',
        success: function (response) {
        updateContent(response);
        },
        error: function (error) {
        console.error('Error fetching paginated data:', error);
        }
    });
    }
    // Function to update the content on the page
    function updateContent(data) {
    var tableBody = $('#data-table tbody');
    tableBody.empty();

    data.data.forEach(function (item) {
        tableBody.append('<tr><td>' + item.column1 + '</td><td>' + item.column2 + '</td></tr>');
    });

    var paginationLinks = $('#pagination-links');
    paginationLinks.html(data.links);
    }

    // Initialize pagination (e.g., on page load)
    fetchApprovedTableData(1); // Fetch the first page of data
    fetchPendingReviewTableData(1); // Fetch the first page of data
    fetchPendingApproveTableData(1); // Fetch the first page of data
    fetchRejectedTableData(1); // Fetch the first page of data
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
                                <h3 class="card-title">Laporan Safety Observation</h3>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="{{ route('safety-observation-forms.create') }}" class="btn btn-primary">
                                    Lapor Temuan Baru</a>
                                </div>
                                <div class="btn-group btn-group-sm d-flex" role="group" aria-label="">
                                    <button type="button" class="btn btn-primary" id="approved-table" onclick="toggle('so-approved-table')">Diterima</button>
                                    <button type="button" class="btn btn-primary" id="pending-review-table" onclick="toggle('so-pending-review-table')">Sedang di Review</button>
                                    <button type="button" class="btn btn-primary" id="pending-approve-table" onclick="toggle('so-pending-approve-table')">Sedang ditinjau Manager</button>
                                    <button type="button" class="btn btn-primary" id="rejected-table" onclick="toggle('so-rejected-table')">Ditolak</button>
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

    {{-- @pushOnce('body-scripts')
    <script>
        let toggle = () => {
           let element = document.getElementById('mydiv');
           element.toggleAttribute('hidden');
        }
    </script>
    @endPushOnce --}}
@endsection
