<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapseLayouts" role="button" aria-expanded="false" aria-controls="collapseLayouts">
                <i class="fas fa-file-alt"></i>
                Form Pelaporan
                <i class="fas fa-angle-down ml-auto"></i>
            </a>
            <div class="collapse" id="collapseLayouts">
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('safety-observation-forms.index') }}">Safety Observation</a></li>
                </ul>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('safety-behavior-checklist.index') }}">Safety Behavior Checklist</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapsePages" role="button" aria-expanded="false" aria-controls="collapsePages">
                <i class="fas fa-book-open"></i>
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'she')
                Pengaturan
                @endif
                <i class="fas fa-angle-down ml-auto"></i>
            </a>
            <div class="collapse" id="collapsePages">
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'she')
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('companies.index') }}">Perusahaan</a></li>
                </ul>
                @endif
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'she')
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('location.index') }}">Lokasi</a></li>
                </ul>
                @endif
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Pengguna</a></li> --}}
            </div>
        </li>
    </ul>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->name }}
    </div>
</div>
