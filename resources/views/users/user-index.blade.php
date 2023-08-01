@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h2>Daftar <i>User</i> <a href="{{ route('users.create') }}" class="btn btn-primary float-right">Buat Pengguna Baru</a></h2>
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
                        </div>
                        <div class="card-body">
                                    <table class="table table-bordered table-responsive sortable">
                                    <thead>
                                    <tr>
                                        <th style="width: 20%">Nama</th>
                                        <th style="width: 20%">NIK</th>
                                        <th style="width: 20%">Perusahaan</th>
                                        <th style="width: 20%">Role</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->count() == 0)
                                        <tr>
                                            <td colspan="5">Tidak ada user yang terdaftar.</td>
                                        </tr>
                                        @endif
                                    @foreach ($users as $user)
                                        <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $companies->find($user->company_id)->company }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href="#" class="button button--primary">
                                            <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="#" class="button button--secondary">
                                            <i class="bi bi-eye"></i> Show
                                            </a>
                                            <a href="#" class="button button--danger">
                                            <i class="bi bi-trash3"></i> Delete
                                            </a>
                                        </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

