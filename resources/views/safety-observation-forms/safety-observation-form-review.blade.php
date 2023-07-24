@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>REVIEEWWW</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Review Safety Observation Form') }}</strong></div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <form action="{{ route('safety-observation-forms.update-reviewed-by-she', $form->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="created_by">Nomor Laporan</label>
                                        <input type="text" name="nomor_laporan" id="nomor_laporan" class="form-control"
                                            value="{{ $form->nomor_laporan }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_finding">Tanggal Temuan</label>
                                        <input type="date" name="date_finding" id="date_finding" class="form-control"
                                            value="{{ $form->date_finding }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="location_id">Lokasi</label>
                                        <input type="text" name="location_id" id="location_id" class="form-control"
                                            value="{{ $form->location->location }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="safety_observation_type">Jenis Laporan</label>
                                        <select name="safety_observation_type" id="safety_observation_type"
                                            class="form-control" disabled>
                                            <option value="">Pilih Jenis Laporan</option>
                                            <option value="unsafe_action"
                                                {{ old('safety_observation_type', $form->safety_observation_type) == 'unsafe_action' ? 'selected' : '' }}>
                                                Unsafe Action</option>
                                            <option value="unsafe_condition"
                                                {{ old('safety_observation_type', $form->safety_observation_type) == 'unsafe_condition' ? 'selected' : '' }}>
                                                Unsafe Condition</option>
                                            <option value="bad_housekeeping"
                                                {{ old('safety_observation_type', $form->safety_observation_type) == 'bad_housekeeping' ? 'selected' : '' }}>
                                                Bad Housekeeping</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Foto Temuan</label><br>
                                        <input type="file" name="image" id="image" class="form-control-file"
                                            accept="image/*" onchange="loadFile(event)">
                                        <img id="output" class="responsive-image"
                                            src="{{ asset('storage/images/' . $form->image) }}" alt="Current Image">
                                        <script>
                                            var loadFile = function(event) {
                                                var output = document.getElementById('output');
                                                output.src = URL.createObjectURL(event.target.files[0]);
                                                output.onload = function() {
                                                    // URL.revokeObjectURL should be called after the image is no longer needed.
                                                }
                                            };
                                        </script>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Deskripsi Temuan</label>
                                        <textarea name="description" id="description" class="form-control" rows="3" disabled>{{ $form->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="hazard_potential">Potensi Bahaya</label>
                                        <input type="text" name="hazard_potential" id="hazard_potential"
                                            class="form-control" value="{{ $form->hazard_potential }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="impact">Dampak Bahaya</label>
                                        <input type="text" name="impact" id="impact" class="form-control"
                                            value="{{ $form->impact }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="short_term_recommendation">Rekomendasi Jangka Pendek</label>
                                        <input type="text" name="short_term_recommendation"
                                            id="short_term_recommendation" class="form-control"
                                            value="{{ $form->short_term_recommendation }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle_term_recommendation">Rekomendasi Jangka Menengah</label>
                                        <input type="text" name="middle_term_recommendation"
                                            id="middle_term_recommendation" class="form-control"
                                            value="{{ $form->middle_term_recommendation }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="long_term_recommendation">Rekomendasi Jangka Panjang</label>
                                        <input type="text" name="long_term_recommendation" id="long_term_recommendation"
                                            class="form-control" value="{{ $form->long_term_recommendation }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="completation_date">Target Tanggal Penyelesaian</label>
                                        <input type="date" name="completation_date" id="completation_date"
                                            class="form-control" value="{{ $form->completation_date }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="created_by">Created By</label>
                                        <input type="text" name="created_by" id="created_by" class="form-control"
                                            value="{{ $form->created_by }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" name="status" id="status" class="form-control"
                                            value="{{ $form->status }}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="review_comment">Review Comment</label>
                                        <textarea name="review_comment" id="review_comment" class="form-control" rows="3"
                                            placeholder="Komentar untuk feedback review"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="reject_comment">Reject Comment</label>
                                        <textarea name="reject_comment" id="reject_comment" class="form-control" rows="3"
                                            placeholder="Komentar untuk feedback tolak laporan"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="reviewed_by">Reviewed By</label>
                                        <input type="text" name="reviewed_by" id="reviewed_by" class="form-control"
                                            value="{{ auth()->user()->id }}" readonly>
                                    </div>

                                    <br>
                                    <footer class="footer">
                                        <!-- Footer content here -->
                                        <button type="submit" name="action" value="approve"
                                            class="btn btn-primary">Approve</button>
                                        <button type="submit" name="action" value="reject"
                                            class="btn btn-danger mx-3">Reject</button>
                                    </footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
