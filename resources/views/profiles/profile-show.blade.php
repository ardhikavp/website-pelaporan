@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Profile</h4>
            </div>
            <div class="card-body">
                <h2>User Information</h2>
                <p>Name: {{ $user->name}}</p>
                <p>Email: {{ $user->username }}</p>

                @if ($company)
                    <h2>Company Information</h2>
                    <p>Name: {{ $company->company }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection