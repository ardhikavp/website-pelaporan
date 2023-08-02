@extends('layouts.dashboard')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar Pengguna</a></li>
            <li class="breadcrumb-item" aria-current="page">Edit Pengguna</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">Edit User</div>
        <div class="card-body">
            <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">Nomor Induk Kependudukan:</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}">
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pegawai" {{ $user->role === 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                        <option value="SHE" {{ $user->role === 'SHE' ? 'selected' : '' }}>SHE</option>
                        <option value="safety officer" {{ $user->role === 'safety officer' ? 'selected' : '' }}>Safety Officer</option>
                        <option value="safety representatif" {{ $user->role === 'safety representatif' ? 'selected' : '' }}>Safety Representatif</option>
                        <option value="manager maintenance" {{ $user->role === 'manager maintenance' ? 'selected' : '' }}>Manager Maintenance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="company_id">Company:</label>
                    <select name="company_id" id="company_id" class="form-control">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ $user->company_id === $company->id ? 'selected' : '' }}>
                                {{ $company->company }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>
@endsection
