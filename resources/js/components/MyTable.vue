<template>
    <div class="table-responsive">
      <h3>PENDING REVIEW</h3>
      <t-table
        :headers="tableHeaders"
        :data="tableData"
        :responsive="true"
        :responsive-breakpoint="520"
      >
        <template slot="tbody" slot-scope="{ row }">
          <tr v-for="form in row" :key="form.id">
            <td style="font-size: 14px;">{{ form.nomor_laporan }}</td>
            <td style="font-size: 14px;">{{ form.createdBy.company.company }}</td>
            <td style="font-size: 14px;">{{ form.safety_observation_type }}</td>
            <td style="font-size: 14px;">
              <template v-if="form.image">
                <img style="width: 50%" :src="getImageUrl(form.image.image)" alt="Image" /><br />
                <a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#fotoModal">
                  Detail Foto
                </a>
              </template>
              <span v-else>No Image</span>
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
            </td>
            <td style="font-size: 14px;">{{ form.createdBy.name }}</td>
            <td style="font-size: 14px;">{{ form.reviewedBy?.name || 'NOT REVIEWED' }}</td>
            <td style="font-size: 14px;">{{ form.approvedBy?.name || 'NOT APPROVED' }}</td>
            <td style="font-size: 14px;">{{ form.status }}</td>
            <td>
                <a href="{{ route('safety-observation-forms.show', ['safety_observation_form' => $form->id]) }}"
                    class="btn btn-sm btn-info my-1"><i class="bi bi-eye"></i></a>

                @can('edit-safety-observation-form', $form)
                    <a href="{{ route('safety-observation-forms.edit', ['safety_observation_form' => $form->id]) }}"
                        class="btn btn-sm btn-secondary my-1"><i
                            class="bi bi-pencil-square"></i></a>
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
        </template>
      </t-table>
      <t-pagination
      :hide-prev-next-controls="renderResponsive"
      :total-items="100"
      :per-page="renderResponsive ? 3 : 5"
      :class="{'ml-auto': !renderResponsive, 'mx-auto': renderResponsive}"
    />
    </div>
  </template>

  <script>
  export default {
    props: {
      tableData: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        tableHeaders: ['Nomor Laporan', 'Nama Perusahaan', 'Jenis', 'Foto', 'Dibuat Oleh', 'Direview Oleh', 'Disetujui Oleh', 'Status', 'Aksi'],
      };
    },
  };
  </script>
