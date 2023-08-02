<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="/logo/safe_surround_check.png" type="image/x-icon">
    @include('layouts.head.head')
    @vite(['resources/sass/app.scss'])
    @stack('head-scripts')
    <style>
        .logo-brand-icon img {
            width: 40%;
        }

        .badge-counter-box {
            display: inline-block;
            padding: 2px 8px;
            border: 1px solid #dc3545;
            border-radius: 15px;
            background-color: #dc3545;
        }

        .badge-counter-box span {
            color: #fff;
            font-weight: bold;
        }

        .dropdown-item .font-weight-bold {
            max-width: 200px; /* Adjust the value as needed to fit your layout */
            white-space: normal;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Adjust the position of the detail button to make it visible */
        .dropdown-item .details-button {
            margin-left: auto;
        }

        .notification-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .details-button {
            color: #8698ab;
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @if (!in_array(request()->route()->getName(), ['register', 'login']))
            @include('layouts.nav.left-side-bar')
        @endif
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.nav.nav-bar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-mx-auto">

                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            {{-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer> --}}
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery/jquery.slim.min.js') }}"></script>
    <!-- Add jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    @stack('body-scripts')
    <script>
    // Add a click event listener to the notification dropdown items
    document.querySelectorAll('.notification-item').forEach(item => {
        item.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent the dropdown from closing
        });
    });

    // Add a click event listener to the document to close the dropdown when clicking outside
    document.addEventListener('click', function () {
        const dropdown = document.getElementById('alertsDropdown');
        if (dropdown.getAttribute('aria-expanded') === 'true') {
            dropdown.click();
        }
    });
    </script>
</body>

</html>
