@extends('layouts.app')

@section('content')
@pushOnce('head-scripts')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
@endPushOnce
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Profile</h4>
        </div>
        <div class="card-body">
            <h2>User Information</h2>
            <p>Name: <b>{{ $user->name }}</b></p>
            <p>Username: <b>{{ $user->username }}</b></p>
            <p>Email: <b>{{ $user->email }}</b></p>
            <p>Role: <b>{{ $user->role }}</b></p>

            @if ($company)
                <h2>Company Information</h2>
                <p>Name: <b>{{ $company->company }}</b></p>
            @endif

            <hr>
            <a href="/edit-profile" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
