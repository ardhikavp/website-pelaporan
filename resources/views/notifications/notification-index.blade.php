@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Notifications') }}</div>
                @if ($notificationData)
                <div class="alert alert-success">
                    {{ is_array($notificationData['data']) ? $notificationData['data']['data'] : $notificationData['data'] }}
                </div>
            @endif
                @if ($notifications->count() > 0)
                @foreach ($notifications as $notification)
                    <div>
                        {{ is_array($notifications['data']) ? $notifications['data']['data'] : $notifications['data'] }}

                    </div>
                @endforeach
            @else
                <div>Tidak ada notifikasi.</div>
            @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
