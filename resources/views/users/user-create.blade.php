@extends('layouts.dashboard')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar Pengguna</a></li>
            <li class="breadcrumb-item" aria-current="page">Buat Pengguna</li>
        </ol>
    <div class="card">
        <div class="card-header">Create New User</div>
        <div class="card-body">
          <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" name="name" id="name" class="form-control">
              @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="username">Nomor Induk Kependudukan:</label>
              <input type="text" name="username" id="username" class="form-control">
              @error('username')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" id="email" class="form-control">
              @error('email')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="role">Role:</label>
              <select name="role" id="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="pegawai">Pegawai</option>
                <option value="SHE">SHE</option>
                <option value="safety officer">Safety Officer</option>
                <option value="safety representatif">Safety Representatif</option>
                <option value="manager maintenance">Manager Maintenance</option>
              </select>
            </div>
            <div class="form-group">
              <label for="company_id">Company:</label>
              <select name="company_id" id="company_id" class="form-control">
                @foreach ($companies as $company)
                  <option value="{{ $company->id }}">{{ $company->company }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <div class="input-group">
                <input type="password" name="password" id="password" class="form-control">
                <div class="input-group-append">
                  <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                    <i id="toggleIcon" class="fa fa-eye"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password_confirmation">Confirm Password:</label>
              <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                <div class="input-group-append">
                  <button type="button" id="toggleConfirmPassword" class="btn btn-outline-secondary">
                    <i id="toggleConfirmIcon" class="fa fa-eye"></i>
                  </button>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
          </form>
        </div>
      </div>
</div>


@pushOnce('body-scripts')
<script>
    $(document).ready(function() {
        $("#togglePassword").on('click', function() {
            togglePasswordVisibility("#password", "#toggleIcon");
        });

        $("#toggleConfirmPassword").on('click', function() {
            togglePasswordVisibility("#password_confirmation", "#toggleConfirmIcon");
        });

        function togglePasswordVisibility(passwordFieldId, toggleIconId) {
            const passwordField = $(passwordFieldId);
            const toggleIcon = $(toggleIconId);

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        }
    });
</script>

@endPushOnce
@endsection
