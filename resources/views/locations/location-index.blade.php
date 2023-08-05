@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Lokasi Perusahaan</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Locations</h2>
                        <a href="{{ route('location.create') }}" class="btn btn-primary float-right">Create Location</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;" class="text-center"><strong>ID</strong></th>
                                        <th style="width: 50%;" class="text-center"><strong>LOKASI</strong></th>
                                        <th style="width: 40%;" class="text-center"><strong>ACTIONS</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locations as $location)
                                        <tr>
                                            <td class="text-center">{{ $location->id }}</td>
                                            <td>{{ $location->location }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('location.edit', $location) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('location.destroy', $location) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this location?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="pagination">
                                {{ $locations->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
