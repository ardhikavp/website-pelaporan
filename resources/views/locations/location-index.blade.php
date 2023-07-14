@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Locations</h4>
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
                            <div class="d-flex justify-content-center">
                                {{ $locations->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
