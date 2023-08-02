<div style="overflow-x:auto;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div style="background-color: #f2f2f2; padding: 10px; margin-top: 10px;">
                <h3 style="font-family: 'Helvetica Neue', sans-serif; color: #090a0a; margin-bottom: 0;">
                    <i class="fas fa-times-circle" style="margin-right: 5px;"></i>
                    Laporan Ditolak
                </h3>
            </div>
        </div>
    </div>
    <br>
    @if (count($form_rejected) > 0)
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
                @foreach ($form_rejected as $answer)
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

    <div class="d-flex justify-content-center" id="pagination-links">
        @if ($form_rejected instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $form_rejected->links() }}
        {{-- {{-- @else --}}
            {{-- show nothing --}}
        @endif
        </div>
        @else
        <div class="text-center mt-3 p-3" style="background-color: #f2f2f2; border-radius: 5px;">
            Tidak terdapat laporan yang telah ditolak.
        </div>
        @endif
    </div>
