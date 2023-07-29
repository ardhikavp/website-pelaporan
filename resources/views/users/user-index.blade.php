@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <a href="{{ route('users.index') }}" class="btn btn-primary" id="btn-users-all">All</a>
            <a href="{{ route('users.create') }}">Create</a>
        </div>
        <div style="mt-1">
            <form action="{{ route('users.index') }}" method="get">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control mb-3 mt-2" placeholder="search" name="q">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="form-control mb-3 mt-2" value="Search">
                    </div>
                </div>
            </form>
        </div>
        <div>
            <h2>Daftar <i>User</i></h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Perusahaan</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $companies->find($user->company_id)->company }}</td>
                            <td>{{ $user->role }}</td>
                            <td >
                                <a href="#" class="button button--primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                  </a>
                                  <a href="#" class="button button--secondary">
                                    <i class="bi bi-eye"></i> Show
                                  </a>
                                  <a href="#" class="button button--danger">
                                    <i class="bi bi-trash3"></i> Delete
                                  </a>
                                {{-- <a href="#" class="btn btn-success"><i class="far fa-check-circle"></i> Approve</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
@endsection

