@extends('layouts.dashboard')

@section('content')
    @pushOnce('head-scripts')
        <script>
            let lastVisibleTable =
            'so-approved-table'; // Tabel awal yang ditampilkan (ganti sesuai ID tabel pertama yang ingin ditampilkan)

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
                font-size: 12px;
                /* Adjust the font size as needed */
                padding: 0.1rem 0.2rem;
                /* Adjust the padding as needed */
            }

            @media (max-width: 576px) {

                /* Customize button size for small screens */
                .btn-group.btn-group-sm .btn {
                    font-size: 12px;
                    /* Adjust the font size as needed */
                    padding: 0.1rem 0.2rem;
                    /* Adjust the padding as needed */
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
                background-color: rgba(0, 0, 0, 0.5);
                /* Semi-transparent black overlay */
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

            .fas {
                font-size: 1rem;
            }

            .fas.fa-fw {
                width: 0.5rem;
            }
        </style>
    @endPushOnce
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Safety Behavior Checklist</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 mx-auto">
                @if(auth()->user()->role == 'SHE')
                <form action="{{ route('notification.generate-low-safety-index-notification') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-bell mr-2"></i> Generate
                        Notification</button>
                </form>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="card-title">Laporan Safety Behavior Checklist</h3>
                            </div>
                            <div class="col-md-3 text-right">
                                @php
                                    $userRole = Auth::user()->role; // Assuming you have a 'role' column in your users table representing the user's role.
                                @endphp
                                @if ($userRole == 'SHE')
                                    <a href="{{ route('safety-behavior-checklist.create') }}"
                                        class="btn btn-primary btn-sm">Catat <i>Safety Behavior Checklist</i> Baru</a>
                                @endif
                            </div>
                            <div class="btn-group btn-group-sm d-flex" role="group" aria-label="">
                                <button type="button" class="btn btn-primary" id="approved-table"
                                    onclick="toggle('so-approved-table')"><strong> Diterima </strong></button>
                                <button type="button" class="btn btn-primary" id="pending-review-table"
                                    onclick="toggle('so-pending-review-table')"><strong> Sedang di Review </strong></button>
                                <button type="button" class="btn btn-primary" id="pending-approve-table"
                                    onclick="toggle('so-pending-approve-table')"><strong> Sedang ditinjau Manager
                                    </strong></button>
                                <button type="button" class="btn btn-primary" id="rejected-table"
                                    onclick="toggle('so-rejected-table')"><strong> Ditolak </strong></button>
                            </div>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                    </div>
                    <div class="card-body" id="so-approved-table">
                        @include('safety-behavior-checklists.safety-behavior-checklist-approved')
                    </div>
                    <div class="card-body" id="so-pending-review-table" hidden>
                        @include('safety-behavior-checklists.safety-behavior-checklist-pending-review')
                    </div>
                    <div class="card-body" id="so-pending-approve-table" hidden>
                        @include('safety-behavior-checklists.safety-behavior-checklist-pending-approve')
                    </div>
                    <div class="card-body" id="so-rejected-table" hidden>
                        @include('safety-behavior-checklists.safety-behavior-checklist-rejected')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    @pushOnce('body-scripts')
        <script>
            // Function to handle modal show/hide
            document.addEventListener('DOMContentLoaded', function() {
                // Get all elements with the class "link-secondary"
                var fotoLinks = document.querySelectorAll('.link-secondary');
                // Loop through all the links and attach event listeners
                fotoLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        var modalId = link.getAttribute(
                        'data-bs-target'); // Get the modal ID from the data-bs-target attribute
                        var fotoModal = new bootstrap.Modal(document.querySelector(modalId));
                        fotoModal.show();
                    });
                });

                // Function to handle modal close (x button)
                var modalCloseButtons = document.querySelectorAll('.modal .btn-close');
                modalCloseButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var modal = button.closest('.modal');
                        var fotoModal = bootstrap.Modal.getInstance(modal);
                        fotoModal.hide();
                    });
                });
            });
        </script>
    @endPushOnce
@endsection
