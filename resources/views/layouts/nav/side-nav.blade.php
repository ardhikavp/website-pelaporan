@push('head-script')
@endpush
<nav class="navbar navbar-expand-lg">
    <div class="offcanvas offcanvas-end p-3" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title opacity-0" id="offcanvasNavbarLabel">title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <ul class="navbar-nav flex flex-column">
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
            @if(auth()->user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapsePages" role="button" aria-expanded="false" aria-controls="collapsePages">
                    <i class="fas fa-book-open"></i>
                    Pengaturan
                    <i class="fas fa-angle-down ml-auto"></i>
                </a>
                <div class="collapse" id="collapsePages">
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('companies.index') }}">Perusahaan</a></li>
                    </ul>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('location.index') }}">Lokasi</a></li>
                    </ul>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Pengguna</a></li>
                    </ul>
                </div>
                @endif
            </li>
        </ul>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name }}
        </div>
    </div>
</nav>

<button class="d-block d-lg-none" id="sidebar-toggle" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">Toggle Sidebar</button> <!-- Add the toggle button here -->

