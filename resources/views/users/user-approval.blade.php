@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>User Approval</h1>
        @foreach ($users as $user)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                    <form action="{{ route('users.accept', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Accept</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
