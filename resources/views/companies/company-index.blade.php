@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Companies</h4>
                        <a href="{{ route('companies.create') }}" class="btn btn-primary float-right">Create Company</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10%;" class="text-center">ID</th>
                                    <th style="width: 20%;" class="text-center">Perusahaan</th>
                                    <th style="width: 10%;" class="text-center">Jumlah Karyawan</th>
                                    <th style="width: 20%;" class="text-center">Safety Index</th>
                                    <th style="width: 20%;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td class="text-center">{{ $company->id }}</td>
                                        <td>{{ $company->company }}</td>
                                        <td class="text-center">{{ $company->users_count }}</td>
                                        <td> </td>
                                        <td>
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
