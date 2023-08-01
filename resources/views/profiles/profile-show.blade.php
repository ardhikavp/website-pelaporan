@extends('layouts.app')

@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Profile  Saya</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <h3>Profile <a href="{{ route('profile.edit', ['profile' => $user->id]) }}" class="btn btn-primary float-right">Edit</a></h3>
            </div>
            <div class="card-body">
                <h4>User Information</h4>
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="username">Nomor Induk Kependudukan</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>
                <div class="form-group">
                    <label for="role">Jabatan</label>
                    <input type="text" name="role" id="role" class="form-control" value="{{ $user->role }}" readonly>
                </div>

                @if ($company)
                    <h4>Informasi Perusahaan</h4>
                    <div class="form-group">
                        <label for="company">Perusahaan</label>
                        <input type="text" name="company" id="company" class="form-control" value="{{ $company->company }}" readonly>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('password.request') }}" class="btn btn-primary">
                        Reset Password
                    </a>
                </div>
            </div>
        </div>
    </div>
@pushOnce('body-scripts')
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
    </script>
    <script>
$(document).ready(function() {
  // Check if the window is less than 992px wide
  if ($(window).width() <= 992) {
    // Hide the sidebar
    $("#left-side-bar").hide();

    // Add a click event to the toggle button
    $("#sidebar-toggle").click(function() {
      // Toggle the sidebar
      $("#left-side-bar").toggle();
    });
  }
});
    </script>
@endPushOnce
@endsection
