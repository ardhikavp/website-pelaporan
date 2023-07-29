@push('head-script')
<style>
@media (max-width: 767px) {
  #sidebar {
    display: none;
  }
}
</style>
@endpush
<div class="flex-shrink-0 p-3 bg-white" style="width: 220px;">
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
@push('body-script')
<script>
$(document).ready(function() {
  // Check if the window is less than 767px wide
  if ($(window).width() <= 767) {
    // Hide the sidebar
    $("#sidebar").hide();

    // Add a click event to the sidebar toggle button
    $("#sidebar-toggle").click(function() {
      // Toggle the sidebar
      $("#sidebar").toggle();
    });
  }
});
</script>
@endpush
