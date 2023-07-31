@extends('layouts.app')

@section('content')
@pushOnce('head-scripts')
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
@endPushOnce
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Profile <a href="/edit-profile" class="btn btn-primary float-right">Edit</a></h3>
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
