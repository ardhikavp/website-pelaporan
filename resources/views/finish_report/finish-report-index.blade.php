@extends('layouts.dashboard')

@section('content')
    <div class="container">
        @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
        <h2>Finish Report</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Laporan</th>
                    <th>Finish Report</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $key => $form)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $form->nomor_laporan }}</td>
                        <td>{{ $form->finish_report }}</td>
                        <td>
                            @if ($form->finish_report_path)
                                <a href="{{ route('progress.so.download', ['filename' => basename($form->finish_report_path)]) }}" class="btn btn-success">Download</a>
                                <a href="{{ route('progress.so.show', ['id' => $form->id]) }}" class="btn btn-success">View PDF</a>
                            @else
                                <a href="{{ route('progress.so.upload', ['id' => $form->id]) }}" class="btn btn-primary">Upload PDF</a>

                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
