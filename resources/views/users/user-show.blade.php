@extends('layouts.dashboard')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar Pengguna</a></li>
            <li class="breadcrumb-item" aria-current="page">{{ $user->name }}</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">User Details</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Nomor Induk Kependudukan:</strong> {{ $user->username }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
            <p><strong>Company:</strong> {{ $user->company->company ?? 'N/A' }}</p>
            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit User</a>
        </div>
    </div>
</div>
@endsection
