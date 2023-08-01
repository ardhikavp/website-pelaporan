@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <a href="{{ route('users.index') }}" class="btn btn-outline-primary" id="btn-users-all">All</a>
            <a href="{{ route('users.pending') }}" class="btn btn-primary" id="btn-users-pending">Pending Approval</a>
            <a href="{{ route('users.approved') }}" class="btn btn-outline-primary" id="btn-users-approved">Approved</a>
            <a href="{{ route('users.rejected') }}" class="btn btn-outline-primary" id="btn-users-rejected">Rejected</a>
        </div>

        <div>
            <h2>Daftar Pengguna</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Perusahaan</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $companies->find($user->company_id)->company }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="#" class="btn btn-primary mr-2"><i class="bi bi-pencil-square"></i> Edit</a>
                                <a href="#" class="btn btn-secondary mr-2"><i class="bi bi-eye"></i> Show</a>
                                <a href="#" class="btn btn-danger"><i class="bi bi-trash3"></i> Delete</a>
                                <a href="#" class="btn btn-success"><i class="far fa-check-circle"></i> Approve</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection

