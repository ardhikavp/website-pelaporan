{{-- <div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
<ul class="">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Main Menu</div>
                <a class="nav-link" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Safety Report</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                    Form Pelaporan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('safety-observation-forms.index') }}">Safety Observation</a>
                        <a class="nav-link" href="{{ route('safety-behavior-checklist.index') }}">Safety Behavior Checklist</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pengaturan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('companies.index') }}">Perusahaan</a>
                        <a class="nav-link" href="{{ route('location.index') }}">Lokasi</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->role }}
        </div>
    </nav>
</ul> --}}
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('safety-behavior-checklist.index') }}">Safety Behavior Checklist</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#collapsePages" role="button" aria-expanded="false" aria-controls="collapsePages">
                <i class="fas fa-book-open"></i>
                Pengaturan
                <i class="fas fa-angle-down ml-auto"></i>
            </a>
            <div class="collapse" id="collapsePages">
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('companies.index') }}">Perusahaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('location.index') }}">Lokasi</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->role }}
    </div>
</div>
