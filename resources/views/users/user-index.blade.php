@extends('layouts.dashboard')

@section('content')
<div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Daftar Pengguna</a></li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h2>Daftar <i>User</i></h2>
                            <div style="mt-1">
                                <form action="{{ route('users.index') }}" method="get">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control mb-3 mt-2" placeholder="search" name="q">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" class="form-control mb-3 mt-2" value="Search">

                                        </div>
                                    </div><a href="{{ route('users.create') }}" class="btn btn-primary float-right-middle">Buat Pengguna Baru</a>
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

