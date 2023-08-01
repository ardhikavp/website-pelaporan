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
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell"></i>
        Notifications
        @if (Auth::check() && Auth::user()->unreadNotifications->count() > 0)
            <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
        <div style="max-height: 300px; overflow-y: auto;"> <!-- Set maximum height and add scrollbar if needed -->
            @if (Auth::user()->unreadNotifications->count() > 0)
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <a href="#" class="dropdown-item text-success">{{ $notification->data['data'] }}</a>
                @endforeach
            @else
                <a href="#" class="dropdown-item text-muted">Belum ada notif</a>
            @endif

            @if (Auth::user()->readNotifications->count() > 0)
                <div class="dropdown-divider"></div>
                <span class="dropdown-header">Read Notifications</span>
                @foreach (auth()->user()->readNotifications as $notification)
                    <a href="#" class="dropdown-item text-secondary">{{ $notification->data['data'] }}</a>
                @endforeach
            @endif
        </div>
    </div>
</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('mark-as-read') }}">
            Mark All as Read
        </a>
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
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                <i class="fas fa-bell"></i> Notifications
                @if (Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                    <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                @endif
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="modal fade" id="notificationsModal" tabindex="-1" role="dialog" aria-labelledby="notificationsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationsModalLabel">Notifications</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <div class="alert alert-success">
                                {{ $notification->data['data'] }}
                            </div>
                        @endforeach
                        @foreach (auth()->user()->readNotifications as $notification)
                            <div class="alert alert-secondary">
                                {{ $notification->data['data'] }}
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </li>
@endguest

