@extends('layouts.app')

@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Laporan Safety Observation</li>
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            </ol>
          </nav>    
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Input Safety Observation</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('safety-observation-forms.create') }}" class="btn btn-primary">Buat
                                    Formulir Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <div class="table-responsive">
                            <h3>PENDING REVIEW</h3>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Nomor Laporan</th>
                                        <th style="width: 10%;">Nama Perusahaan</th>
                                        <th style="width: 10%;">Jenis</th>
                                        <th style="width: 30%;">Foto</th>
                                        <th style="width: 15%;">Dibuat Oleh</th>
                                        <th style="width: 15%;">Direview Oleh</th>
                                        <th style="width: 15%;">Disetujui Oleh</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($form_pending_review as $form)
                                        <tr>
                                            <td style="font-size: 14px;">{{ $form->nomor_laporan }}</td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->company->company }}</td>
                                            <td style="font-size: 14px;">{{ $form->safety_observation_type }}</td>
                                            <td style="font-size: 14px;">
                                                @if ($form->image)
                                                    <img style="width: 50%"
                                                        src="{{ url('/images/' . $form->image->image) }}"
                                                        alt="Image"><br>
                                                    {{-- <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#fotoModal">
                                                    Detail Foto
                                                </button> --}}
                                                    <a href="#" class="link-secondary" data-bs-toggle="modal"
                                                        data-bs-target="#fotoModal">Detail Foto</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="fotoModal" tabindex="-1"
                                                        aria-labelledby="fotoModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="fotoModalLabel">
                                                                        Foto
                                                                        Laporan</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <img style="width: 100%"
                                                                        src="{{ url('/images/' . $form->image->image) }}"
                                                                        alt="Image">
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->name }}</td>
                                            <td style="font-size: 14px;">
                                                {{ $form->reviewedBy?->name ?? 'NOT REVIEWED' }}
                                            </td>
                                            <td style="font-size: 14px;">
                                                {{ $form->approvedBy?->name ?? 'NOT APPROVED' }}
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->status }}</td>
                                            <td>
                                                <a href="{{ route('safety-observation-forms.show', ['safety_observation_form' => $form->id]) }}"
                                                    class="btn btn-sm btn-info my-1"><i class="bi bi-eye"></i></a>

                                                @can('edit-safety-observation-form', $form)
                                                    <!-- Assuming $form is the Safety Observation Form you want to edit -->
                                                    <a href="{{ route('safety-observation-forms.edit', ['safety_observation_form' => $form->id]) }}"
                                                        class="btn btn-sm btn-secondary my-1"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    {{-- <a href="{{ route('safety-observation-forms.edit') }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a> --}}
                                                @endcan
                                                @can('give-safety-observation-review', $form)
                                                    <a href="{{ route('safety-observation-forms.review-by-she', ['safety_observation_form' => $form->id]) }}"
                                                        class="btn btn-sm btn-primary my-1"><i class="bi bi-pass"></i></a>
                                                @endcan
                                                @can('give-safety-observation-approve', $form)
                                                    <a href="{{ route('safety-observation-forms.approve-by-manager', ['safety_observation_form' => $form->id]) }}"
                                                    class="btn btn-sm btn-primary my-1"><i class="bi bi-pass"></i></a>
                                                @endcan
                                                @can('delete-safety-observation-form', $form)
                                                    <form action="{{ route('safety-observation-forms.destroy', $form->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger my-1"
                                                            onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                                class="bi bi-trash3" data-bs-toggle="tooltip"
                                                                title="Hapus Laporan"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- {!! $form_pending_review->withQueryString()->links('pagination::bootstrap-5') !!} --}}
                            {{-- {{ $form_pending_review->links('pagination::bootstrap-5') }} --}}
                            @if ($form_pending_review instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $form_pending_review->links() }}
                            @endif
                        </div>

                        <div class="table-responsive mb-3">
                            <h3>PENDING APPROVAL</h3>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Nomor Laporan</th>
                                        <th style="width: 10%;">Nama Perusahaan</th>
                                        <th style="width: 10%;">Jenis</th>
                                        <th style="width: 30%;">Foto</th>
                                        <th style="width: 15%;">Dibuat Oleh</th>
                                        <th style="width: 15%;">Direview Oleh</th>
                                        <th style="width: 15%;">Disetujui Oleh</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($form_pending_approval as $form)
                                        <tr>
                                            <td style="font-size: 14px;">{{ $form->nomor_laporan }}</td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->company->company }}</td>
                                            <td style="font-size: 14px;">{{ $form->safety_observation_type }}</td>
                                            <td style="font-size: 14px;">
                                                @if ($form->image)
                                                    <img style="width: 50%"
                                                        src="{{ url('/images/' . $form->image->image) }}"
                                                        alt="Image"><br>
                                                    {{-- <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#fotoModal">
                                                    Detail Foto
                                                </button> --}}
                                                    <a href="#" class="link-secondary" data-bs-toggle="modal"
                                                        data-bs-target="#fotoModal">Detail Foto</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="fotoModal" tabindex="-1"
                                                        aria-labelledby="fotoModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="fotoModalLabel">
                                                                        Foto
                                                                        Laporan</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <img style="width: 100%"
                                                                        src="{{ url('/images/' . $form->image->image) }}"
                                                                        alt="Image">
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->name }}</td>
                                            <td style="font-size: 14px;">
                                                {{ $form->reviewedBy?->name ?? 'NOT REVIEWED' }}
                                            </td>
                                            <td style="font-size: 14px;">
                                                {{ $form->approvedBy?->name ?? 'NOT APPROVED' }}
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->status }}</td>
                                            <td>
                                                <a href="{{ route('safety-observation-forms.show', ['safety_observation_form' => $form->id]) }}"
                                                    class="btn btn-sm btn-info my-1"><i class="bi bi-eye"></i></a>
                                                @can('edit-safety-observation-form', $form)
                                                    <!-- Assuming $form is the Safety Observation Form you want to edit -->
                                                    <a href="{{ route('safety-observation-forms.edit', ['safety_observation_form' => $form->id]) }}"
                                                        class="btn btn-sm btn-secondary my-1"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    {{-- <a href="{{ route('safety-observation-forms.edit') }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a> --}}
                                                @endcan
                                                @can('give-safety-observation-review', $form)
                                                    <a href="{{ route('safety-observation-forms.review-by-she', ['safety_observation_form' => $form->id]) }}"
                                                        class="btn btn-sm btn-primary my-1"><i class="bi bi-pass"></i></a>
                                                @endcan
                                                @can('give-safety-observation-approve', $form)
                                                <a href="{{ route('safety-observation-forms.approve-by-manager', ['safety_observation_form' => $form->id]) }}" class="btn btn-sm btn-primary my-1"><i class="bi bi-pass"></i></a>
                                                @endcan
                                                @can('delete-safety-observation-form', $form)
                                                    <form action="{{ route('safety-observation-forms.destroy', $form->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger my-1"
                                                            onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                                class="bi bi-trash3" data-bs-toggle="tooltip"
                                                                title="Hapus Laporan"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{-- {{ $form_pending_approval->links() }} --}}
                                @if ($form_pending_approval instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    {{ $form_pending_approval->links() }}
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive mb-3">
                            <h3>APPROVED</h3>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Nomor Laporan</th>
                                        <th style="width: 10%;">Nama Perusahaan</th>
                                        <th style="width: 10%;">Jenis</th>
                                        <th style="width: 30%;">Foto</th>
                                        <th style="width: 15%;">Dibuat Oleh</th>
                                        <th style="width: 15%;">Direview Oleh</th>
                                        <th style="width: 15%;">Disetujui Oleh</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($form_approved as $form)
                                        <tr>
                                            <td style="font-size: 14px;">{{ $form->nomor_laporan }}</td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->company->company }}</td>
                                            <td style="font-size: 14px;">{{ $form->safety_observation_type }}</td>
                                            <td style="font-size: 14px;">
                                                @if ($form->image)
                                                    <img style="width: 50%"
                                                        src="{{ url('/images/' . $form->image->image) }}"
                                                        alt="Image"><br>
                                                    {{-- <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#fotoModal">
                                                    Detail Foto
                                                </button> --}}
                                                    <a href="#" class="link-secondary" data-bs-toggle="modal"
                                                        data-bs-target="#fotoModal">Detail Foto</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="fotoModal" tabindex="-1"
                                                        aria-labelledby="fotoModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="fotoModalLabel">Foto
                                                                        Laporan</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <img style="width: 100%"
                                                                        src="{{ url('/images/' . $form->image->image) }}"
                                                                        alt="Image">
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->name }}</td>
                                            <td style="font-size: 14px;">{{ $form->reviewedBy?->name ?? 'NOT REVIEWED' }}
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->approvedBy?->name ?? 'NOT APPROVED' }}
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->status }}</td>
                                            <td>
                                                <a href="{{ route('safety-observation-forms.show', ['safety_observation_form' => $form->id]) }}"
                                                    class="btn btn-sm btn-info my-1"><i class="bi bi-eye"></i></a>
                                                @can('edit-safety-observation-form', $form)
                                                    <!-- Assuming $form is the Safety Observation Form you want to edit -->
                                                    <a href="{{ route('safety-observation-forms.edit', ['safety_observation_form' => $form->id]) }}"
                                                        class="btn btn-sm btn-secondary my-1"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    {{-- <a href="{{ route('safety-observation-forms.edit') }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a> --}}
                                                @endcan
                                                @can('give-safety-observation-review', $form)
                                                    <a href="{{ route('safety-observation-forms.review-by-she', ['safety_observation_form' => $form->id]) }}"
                                                        class="btn btn-sm btn-primary my-1"><i class="bi bi-pass"></i></a>
                                                @endcan
                                                @can('give-safety-observation-approve', $form)
                                                    <a href="{{ route('safety-observation-forms.approve-by-manager', [' ' => $form->id]) }}"
                                                    class="btn btn-sm btn-primary my-1"><i class="bi bi-pass"></i></a>
                                                @endcan
                                                @can('delete-safety-observation-form', $form)
                                                    <form action="{{ route('safety-observation-forms.destroy', $form->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger my-1"
                                                            onclick="return confirm('Are you sure you want to delete this item?')"><i
                                                                class="bi bi-trash3" data-bs-toggle="tooltip"
                                                                title="Hapus Laporan"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{-- {{ $form_approved->links() }} --}}
                                @if ($form_approved instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    {{ $form_approved->links() }}
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive mb-3">
                            <h3>REJECTED</h3>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Nomor Laporan</th>
                                        <th style="width: 10%;">Nama Perusahaan</th>
                                        <th style="width: 10%;">Jenis</th>
                                        <th style="width: 30%;">Foto</th>
                                        <th style="width: 15%;">Dibuat Oleh</th>
                                        <th style="width: 15%;">Direview Oleh</th>
                                        <th style="width: 15%;">Disetujui Oleh</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($form_rejected as $form)
                                        <tr>
                                            <td style="font-size: 14px;">{{ $form->nomor_laporan }}</td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->company->company }}</td>
                                            <td style="font-size: 14px;">{{ $form->safety_observation_type }}</td>
                                            <td style="font-size: 14px;">
                                                @if ($form->image)
                                                    <img style="width: 50%"
                                                        src="{{ url('/images/' . $form->image->image) }}"
                                                        alt="Image"><br>
                                                    {{-- <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#fotoModal">
                                                    Detail Foto
                                                </button> --}}
                                                    <a href="#" class="link-secondary" data-bs-toggle="modal"
                                                        data-bs-target="#fotoModal">Detail Foto</a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="fotoModal" tabindex="-1"
                                                        aria-labelledby="fotoModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="fotoModalLabel">Foto
                                                                        Laporan</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <img style="width: 100%"
                                                                        src="{{ url('/images/' . $form->image->image) }}"
                                                                        alt="Image">
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->createdBy->name }}</td>
                                            <td style="font-size: 14px;">{{ $form->reviewedBy?->name ?? 'NOT REVIEWED' }}
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->approvedBy?->name ?? 'NOT APPROVED' }}
                                            </td>
                                            <td style="font-size: 14px;">{{ $form->status }}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-info">Lihat</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $form_rejected->links() }} --}}
                            @if ($form_rejected instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $form_rejected->links() }}
                            @else
                                show nothing
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
