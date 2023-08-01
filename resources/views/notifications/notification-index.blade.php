@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Notifications') }}</div>

                <div class="card-body">
                    @forelse ($notifications as $notification)
                        <p>{{ $notification->data['message'] }}</p>
                        <a href="{{ $notification->data['url'] }}">View Details</a>
                        <hr>
                    @empty
                        <p>No new notifications.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
