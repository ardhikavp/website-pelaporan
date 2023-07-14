@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Input Safety Observation</h4>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('safety-observation-forms.create') }}" class="btn btn-primary">Buat Formulir Baru</a>
                                </div>
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
                                        <th style="width: 10%;">Nomor Laporan</th>
                                        <th style="width: 10%;">Jenis</th>
                                        <th style="width: 30%;">Foto</th>
                                        <th style="width: 15%;">Dibuat Oleh</th>
                                        <th style="width: 15%;">Disetujui Oleh</th>
                                        <th style="width: 20%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($forms as $form)
                                        <tr>
                                            <td style="font-size: 14px;">{{ $form->nomor_laporan }}</td>
                                            <td style="font-size: 14px;">{{ $form->safety_observation_type }}</td>
                                            <td style="font-size: 14px;">{{ $form->image->image }}</td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->name }}</td>
                                            <td style="font-size: 14px;">{{ $form->approvedBy->name }}</td>
                                            <td style="font-size: 14px;">{{ $form->status }}</td>
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
