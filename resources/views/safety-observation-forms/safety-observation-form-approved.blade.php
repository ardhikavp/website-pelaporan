
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
    <table class="table table-bordered scroller" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 20%;">Nomor Laporan</th>
                <th style="width: 15%;">Jenis</th>
                <th style="width: 30%;">Foto</th>
                <th style="width: 15%;">Dibuat Oleh</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($form_approved as $form)
                <tr>
                    <td style="font-size: 14px;">{{ $form->nomor_laporan }}</td>
                    <td style="font-size: 14px;">{{ str_replace('_', ' ', $form->safety_observation_type) }}</td>
                    <td style="font-size: 14px;">
                        @if ($form->image)
                        <img style="width: 50%" src="{{ url('/images/' . $form->image->image) }}" alt="Image"><br>
                        <a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#fotoModal_{{ $form->id }}">Detail Foto</a>

                        <!-- Modal -->
                        <div class="modal fade" id="fotoModal_{{ $form->id }}" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="fotoModalLabel">Foto Laporan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img style="width: 100%" src="{{ url('/images/' . $form->image->image) }}" alt="Image">
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
                    <td style="font-size: 14px;">{{ $form->status }}</td>
                    <td class="text-center " style="display: flex;">
                        <a href="{{ route('safety-observation-forms.show', ['safety_observation_form' => $form->id]) }}"
                            class="btn" style="background-color: #89c4d1; color: #373737; width: auto; padding: auto; height:auto; margin: 1px;">
                            <i class="fas fa-eye"></i> Lihat</a>
                        @can('edit-safety-observation-form', $form)
                            <a href="{{ route('safety-observation-forms.edit', ['safety_observation_form' => $form->id]) }}"
                                class="btn" style="background-color: #485457; color: #ffffff; width: auto; padding: auto; height:auto; margin: 1px;"><i class="fas fa-pencil-alt"></i> Edit</a>
                        @endcan
                        @can('give-safety-observation-review', $form)
                            <a href="{{ route('safety-observation-forms.review-by-she', ['safety_observation_form' => $form->id]) }}"
                                class="btn"  style="background-color: #cd9f4b; color: #000000; width: auto; padding: auto; height:auto; margin: 1px;"><i class="fas fa-check"> Review</i></a>
                        @endcan
                        @can('give-safety-observation-approve', $form)
                            <a href="{{ route('safety-observation-forms.approve-by-manager', ['safety_observation_form' => $form->id]) }}"
                            class="btn" style="background-color: #274cd3; color: #ffffff; width: auto; padding: auto; height:auto; margin: 1px;"><i class="fas fa-clipboard-check"></i> Approve</a>
                        @endcan
                        @can('delete-safety-observation-form', $form)
                            <form action="{{ route('safety-observation-forms.destroy', $form->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background-color: #FF0000; color: #ffffff; width: auto; padding: auto; height:auto; margin: 1px;"
                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
                                        class="fas fa-trash"></i> Delete</button>
                            </form>
                        @endcan
                        @can('export-safety-observation-form', $form)
                        <a href="{{ route('laporan-pdf-generator.download_so_report', ['safety_observation_form' => $form->id]) }}"
                            class="btn" style="background-color: #102ce0; color: #ffffff; width: auto; padding: auto; height:auto; margin: 1px;">
                            <i class="fas fa-file-download"></i> Export</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center" id="pagination-links">
        {{-- {{ $form_approved->links() }} --}}
        @if ($form_approved instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $form_approved->links() }}
        @endif
    </div>
    @else
    <div class="text-center mt-3 p-3" style="background-color: #f2f2f2; border-radius: 5px;">
        Tidak terdapat laporan yang telah di-review.
    </div>
    @endif
</div>
