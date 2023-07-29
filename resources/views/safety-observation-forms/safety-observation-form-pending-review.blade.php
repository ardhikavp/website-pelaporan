<div style="overflow-x:auto;">
    <h3>PENDING REVIEW</h3>
    <table class="table table-responsive table-bordered scroller" id="mytable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nomor Laporan</th>
                <th>Nama Perusahaan</th>
                <th>Jenis</th>
                <th>Foto</th>
                <th>Dibuat Oleh</th>
                <th>Status</th>
                <th>Aksi</th>
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
                    <td style="font-size: 14px;">{{ $form->status }}</td>
                    <td>
                        <a href="{{ route('safety-observation-forms.show', ['safety_observation_form' => $form->id]) }}"
                            class="btn btn-sm btn-info my-1"><i class="bi bi-eye"></i></a><br>

                        @can('edit-safety-observation-form', $form)
                            <a href="{{ route('safety-observation-forms.edit', ['safety_observation_form' => $form->id]) }}"
                                class="btn btn-sm btn-secondary my-1"><i
                                    class="bi bi-pencil-square"></i></a><br>
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
    @if ($form_pending_review instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $form_pending_review->links() }}
    @endif
</div>