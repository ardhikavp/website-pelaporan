@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="row justify-content-center">
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
                    @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" max-width="500px">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Nomor Laporan</th>
                                    <th style="width: 15%;">Pekerjaan</th>
                                    <th style="width: 30%;">Perusahaan</th>
                                    <th style="width: 20%;">Safety Index</th>
                                    <th>Status</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($answers as $answer)
                                <tr>
                                    <td>{{ $answer->nomor_laporan }}</td>
                                    <td>{{ $answer->operation_name }}</td>
                                    <td>{{ $companies->find($answer->company_id)->company }}</td>
                                    <td>{{ $answer->safety_index }}%</td>
                                    <td>{{ $answer->status }}</td>
                                    <td>
                                        <a href="{{ route('safety-behavior-checklist.show', $answer->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye" title="Lihat"></i></a>
                                        <a href="{{ route('safety-behavior-checklist.edit', $answer->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                        <form action="{{ route('safety-behavior-checklist.destroy', $answer) }}" method="POST" class="btn btn-sm btn-danger">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash-alt" title="Delete"></i></button>
                                        </form>
                                        <a href="{{ route('safety-behavior-checklist.review-by-pic', ['answer' => $answer->id]) }}"
                                            class="btn btn-sm btn-primary my-1"><i class="bi bi-pass"></i></a>
                                        <a href="{{ route('safety-behavior-checklist.approve-by-manager', ['answer' => $answer->id]) }}"
                                            class="btn btn-sm btn-primary my-1"><i class="bi bi-pass"></i></a>
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
