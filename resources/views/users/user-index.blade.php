@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Pending Approval</label>
{{--
            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Approved</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio3">Rejected</label> --}}
        </div>

        <div>
            <h2>Daftar Pengguna</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Perusahaan</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $companies->find($user->company_id)->company }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="#" class="btn btn-primary mr-2"><i class="far fa-edit"></i> Edit</a>
                                <a href="#" class="btn btn-secondary mr-2"><i class="far fa-eye"></i> Show</a>
                                <a href="#" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</a>
                                <a href="#" class="btn btn-success"><i class="far fa-check-circle"></i> Approve</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
{{--
        <div id="approved-users" style="display: none;">
            <h2>Daftar Pengguna dengan Status APPROVED</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Perusahaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($approvedUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $companies->find($user->company_id)->company }}</td>
                            <td>{{ $user->role }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="rejected-users" style="display: none;">
            <h2>Daftar Pengguna dengan Status REJECTED</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Perusahaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rejectedUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $companies->find($user->company_id)->company }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
@endsection

