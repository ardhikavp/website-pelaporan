@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Nama Perusahaan</a></li>
                </ol>
            </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Companies</h2>
                        <a href="{{ route('companies.create') }}" class="btn btn-primary float-right">Create Company</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10%;" class="text-center">ID</th>
                                    <th style="width: 20%;" class="text-center">Perusahaan</th>
                                    <th style="width: 10%;" class="text-center">Jumlah Karyawan</th>
                                    {{-- <th style="width: 20%;" class="text-center">Safety Index</th> --}}
                                    <th style="width: 20%;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td class="text-center">{{ $company->id }}</td>
                                        <td>{{ $company->company }}</td>
                                        <td class="text-center">{{ $company->users_count }}</td>
                                        {{-- <td>{{ $safetyIndex->company }}%</td> --}}
                                        <td class="text-center">
                                            <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
