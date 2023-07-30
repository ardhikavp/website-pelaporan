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
    <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotif" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-bell"></i> <!-- Font Awesome bell icon -->
            <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownNotif">
            @if (auth()->user()->unreadNotifications->count() > 0)
                <a class="dropdown-item" href="{{ route('notifications.index') }}">
                    All Notifications
                </a>
                @foreach (auth()->user()->unreadNotifications as $notification)
                    @if ($notification->type === 'needReviewDocument')
                        <a class="dropdown-item" href="{{ $notification->url }}">
                            {{ $notification->message }}
                        </a>
                    @endif
                @endforeach
            @else
                <a class="dropdown-item" href="#">
                    No unread notifications
                </a>
            @endif
        </div>
    </li>
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



            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>


        </div>
    </li>
@endguest
@push('body-script')
<script>
    window.notifications = {
        needReviewDocument: {
            message: 'You have a new form submission that requires review.',
            action: 'Review',
            url: '/safety-observation-forms/<% notification.id %>',
        },
    };
</script>
@endpush
