@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit company') }}</div>

                    <div class="card-body">
                        <form action="{{ route('companies.update', $company) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="company">Perusahaan</label>
                                <input type="text" name="company" id="company" class="form-control" value="{{ $company->company }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
