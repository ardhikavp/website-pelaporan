@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Notifikasi</a></li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <h1>Notifications</h1>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($notifications as $notification)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($notification->read_at)
                                            <strong>Read:</strong>
                                        @else
                                            <strong>Unread:</strong>
                                        @endif
                                        {!! $notification->data['data'] !!} {{-- Use the correct key for the data --}}
                                    </div>
                                    <div>
                                        <a href="{{ $notification->data['url'] }}" class="btn btn-primary">View</a>
                                        <a href="{{ route('mark-notification-as-read-db', ['id' => $notification->id]) }}" class="btn btn-primary">Mark as Read</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
