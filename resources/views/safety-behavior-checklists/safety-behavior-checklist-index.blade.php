@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="text left">
                            <h4 class="card-title">Input Safety Observation</h4>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('safety-behavior-checklist.create') }}" class="btn btn-primary">Catat <i>Safety Behavior Checklist</i> Baru</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Nomor Laporan</th>
                                    <th style="width: 15%;">Pekerjaan</th>
                                    <th style="width: 30%;">Perusahaan</th>
                                    <th style="width: 20%;">Status</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($answers as $answer)
                                <tr>
                                    <td>{{ $answer->id }}</td>
                                    <td>{{ $answer->operation_name }}</td>
                                    <td>{{ $companies->find($answer->company_id)->company }}</td>
                                    <td>Approved</td>
                                    <td>
                                        <a href="{{ route('safety-behavior-checklist.show', $answer->id) }}" class="btn btn-info">Lihat</a>
                                        <a href="{{ route('safety-behavior-checklist.edit', $answer->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('safety-behavior-checklist.destroy', $answer) }}" method="POST" class="btn btn-danger">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
