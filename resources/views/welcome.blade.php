<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>
          Test
        </title>
        <meta name="description" content="Simple landind page" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
        <!--Replace with your tailwind.css once created-->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
        <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
        @vite(['resources/sass/app.scss' , 'resources/js/app.js'])
        <style>
          .gradient {
            background: linear-gradient(90deg, #d53369 0%, #daae51 100%);
          }
        </style>
            <style>
                body {
                    background-color: #f7fafc;
                }

                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 40px;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }

                .title {
                    font-size: 24px;
                    font-weight: bold;
                    color: #333;
                }

                .description {
                    margin-top: 20px;
                    font-size: 16px;
                    color: #666;
                }

                .btn {
                    display: inline-block;
                    margin-top: 30px;
                    padding: 10px 20px;
                    background-color: #4a86e8;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 4px;
                    transition: background-color 0.3s ease;
                }

                .btn:hover {
                    background-color: #2563d8;
                }
            </style>
    </head>
    <body class="antialiased bg-transparent">
        <div id="app">
            <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-3xl mx-auto text-center">
                        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl">Selamat Datang di Website Pelaporan PT PJA</h1>
                        <p class="mt-3 text-xl text-gray-500 dark:text-gray-300 sm:mt-4">Keselamatan dimulai dari melaporkan ketidaksesuaian K3 di lingkungan sendiri.</p>
                        <div class="mt-6">
                            <a href="" class="inline-block px-5 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

