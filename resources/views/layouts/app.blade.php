<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Menambahkan link CSS SweetAlert -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"> --}}
    <!-- Menambahkan script SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style type="text/css">
        body{
            overflow: scroll;
            height: 100vh;
        }
        i{
            font-size: 100%;
        }

    </style>
     <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
     <style>
        @media (max-width: 767px) {
          #sidebarssc {
            display: none;
          }

          .show-sidebarssc #sidebarssc {
            display: block;
          }
        }
        </style>
        <style>
            .container {
                max-width: 960px;
                margin: 0 auto;
            }

            .card {
                margin-bottom: 20px;
            }

            .card-header {
                border-bottom: 1px solid #ccc;
            }

            .card-body {
                padding: 10px;
            }

            .form-group {
                margin-bottom: 10px;
            }

            input {
                width: 100%;
            }

            .btn {
                color: white;
                background-color: #007bff;
                border: none;
                border-radius: 1px;
                padding: 5px 10px;
                cursor: pointer;
            }

            .btn-primary {
                background-color: #0056b3;
            }

            @media (max-width: 576px) {
                .container {
                    max-width: 100%;
                }
            }

            /* NH Housing Primary Brand Colors Color Palette */

            .nh-red {
                color: #d34b4b;
            }

            .nh-blue {
                color: #007bff;
            }

            .nh-green {
                color: #4caf50;
            }

            .nh-yellow {
                color: #ffc107;
            }

            .nh-gray {
                color: #999;
            }
            </style>
    @stack('head-scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @include('layouts.nav.top-nav')
                    </ul>
                </div>
            </div>
        </nav>
        <div>
            <div>
                <div class="row">
                    @if (!in_array(request()->route()->getName(), ['register', 'login']))
                        <div class="col-lg-3 card" id="sidebar">
                            <!-- Sidebar -->
                                @include('layouts.nav.side-nav')
                        </div>
                    @endif
                    <div class="col-lg-9 card" id="main-content">
                        <!-- Konten lainnya -->
                        <main class="py-4">
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('body-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


    {{-- <script src="{{ asset('/resources/js/chartpie.js') }}"></script> --}}
    @include('layouts.script.sidebar')
</body>
</html>
