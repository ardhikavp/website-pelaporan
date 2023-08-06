<div style="overflow-x:auto;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div style="background-color: #f2f2f2; padding: 10px;">
                    <h3 style="font-family: 'Helvetica Neue', sans-serif; color: #090a0a; margin-bottom: 0;">
                        <i class="fas fa-check-circle" style="margin-right: 5px;"></i>
                        Laporan Disetujui
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <br>
    @if (count($form_approved) > 0)
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" max-width="500px">
            <thead>
                <tr>
                    <th style="width: 15%;">Nomor Laporan</th>
                    <th style="width: 15%;">Pekerjaan</th>
                    <th style="width: 2%;">Perusahaan</th>
                    <th style="width: 20%;">Safety Index</th>
                    <th>Status</th>
                    <th style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($form_approved as $answer)
                <tr>
                    <td>{{ $answer->nomor_laporan }}</td>
                    <td>{{ $answer->operation_name }}</td>
                    <td>{{ $companies->find($answer->company_id)->company }}</td>
                    <td>{{ $answer->safety_index }}%</td>
                    <td>{{ $answer->status }}</td>
                    <td class="text-center " style="display: flex;">
                        @can('view-safety-behavior-checklist', $answer)
                        <a href="{{ route('safety-behavior-checklist.show', $answer->id) }}" class="btn" style="background-color: #89c4d1; color: #373737; width: auto; padding: auto; height:auto; margin: 1px;">
                            <i class="fas fa-folder-open" title="Lihat"> Lihat </i></a>
                        @endcan
                        @can('edit-safety-behavior-checklist', $answer)
                        <a href="{{ route('safety-behavior-checklist.edit', $answer->id) }}" class="btn" style="background-color: #485457; color: #ffffff; width: auto; padding: auto; height:auto; margin: 1px;">
                            <i class="fas fa-pencil-alt" title="Edit"> Edit</i></a>
                        @endcan
                        @can('delete-safety-behavior-checklist', $answer)
                        <form action="{{ route('safety-behavior-checklist.destroy', $answer) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: #FF0000; color: #ffffff; width: auto; padding: auto; height:auto; margin: 1px;" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash-alt" title="Delete"> Delete</i></button>
                        </form>
                        @endcan
                        @can('review-safety-behavior-checklist', $answer)
                        <a href="{{ route('safety-behavior-checklist.review-by-pic', ['answer' => $answer->id]) }}"
                            class="btn" style="background-color: #cd9f4b; color: #000000; width: auto; padding: auto; height:auto; margin: 1px;">
                            <i class="bi bi-pass"></i> Tinjau</a>
                        @endcan
                        @can('approve-safety-behavior-checklist', $answer)
                        <a href="{{ route('safety-behavior-checklist.approve-by-manager', ['answer' => $answer->id]) }}"
                            class="btn" style="background-color: #274cd3; color: #ffffff; width: auto; padding: auto; height:auto; margin: 1px;">
                            <i class="bi bi-pass"></i> Approve</a>
                        @endcan
                        @can('export-safety-behavior-checklist', $answer)
                        <a href="{{ route('laporan-pdf-generator.download_sbc_report', ['safety_behavior_checklist' => $answer->id]) }}"
                            class="btn" style="background-color: #102ce0; color: #ffffff; width: auto; padding: auto; height:auto; margin: 1px;">
                            <i class="fas fa-file-download"> Export</i></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center" id="pagination-links">
        {{-- {{ $form_approved->links() }} --}}
        @if ($form_approved instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $form_approved->links() }}
        @endif
    </div>
    @else
    <div class="text-center mt-3 p-3" style="background-color: #f2f2f2; border-radius: 5px;">
        Tidak terdapat laporan yang telah disetujui.
    </div>
    @endif
</div>
