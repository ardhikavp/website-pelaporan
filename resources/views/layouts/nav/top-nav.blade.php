@guest
@if (Route::has('login'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>
@endif

@if (Route::has('register'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
    </li>
@endif
@else
{{-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell"></i>
        Notifications
        @if (Auth::check() && Auth::user()->unreadNotifications->count() > 0)
            <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
        <div class="list-group" style="max-height: 300px; overflow-y: auto;">
            <!-- Unread Notifications -->
            @if (Auth::user()->unreadNotifications->count() > 0)
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <div class="card mb-2">
                        <div class="card-body">
                            @if (isset($notification->data['url']))
                                <a href="{{ $notification->data['url'] }}" class="card-link text-success">{{ $notification->data['data'] }}</a>
                            @else
                                <span class="card-text text-success">{{ $notification->data['data'] }}</span>
                            @endif
                            @if (!$notification->read_at)
                            <form action="{{ route('mark-notification-as-read-db', ['id' => $notification->id]) }}" method="POST">
                                @csrf
                                <button type="submit">Mark as Read</button>
                            </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <a href="#" class="dropdown-item text-muted">Belum ada notif</a>
            @endif

            <div class="dropdown-divider"></div>
            <span class="dropdown-header">Read Notifications</span>
            <!-- Read Notifications -->
            @if (Auth::user()->readNotifications->count() > 0)
                @foreach (auth()->user()->readNotifications as $notification)
                    <div class="card mb-2">
                        <div class="card-body">
                            @if (isset($notification->data['url']))
                                <a href="{{ $notification->data['url'] }}" class="card-link text-secondary">{{ $notification->data['data'] }}</a>
                            @else
                                <span class="card-text text-secondary">{{ $notification->data['data'] }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</li> --}}
{{-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell"></i>
        Notifications
        @if (Auth::check() && Auth::user()->unreadNotifications->count() > 0)
            <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
        @endif
    </a>
</li> --}}






    <li class="nav-item">
        <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}"><i class="fas fa-portrait float">Profile</i></a>
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="fas fa-door-open">{{ __('Logout') }}</i>
            </a>
            <div class="dropdown-divider"></div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>

@endguest

