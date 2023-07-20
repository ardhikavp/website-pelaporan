@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New User</h2>
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control">
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
                    <!-- Tampilkan pilihan perusahaan sesuai data yang ada di database -->
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection
