@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Safety Observation Form Details') }}</strong></div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="created_by">Nomor Laporan</label>
                                        <input type="text" name="nomor_laporan" id="nomor_laporan" class="form-control"
                                            value="{{ $safety_observation_form->nomor_laporan }}" readonly>
                                        </div>

                                    <div class="form-group">
                                        <label for="date_finding">Tanggal Temuan</label>
                                        <input type="text" name="date_finding" id="date_finding" class="form-control"
                                            value="{{ $safety_observation_form->date_finding }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="location_id">Lokasi</label>
                                        <input type="text" name="location_id" id="location_id" class="form-control"
                                            value="{{ $safety_observation_form->location->location }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="safety_observation_type">Jenis Laporan</label>
                                        <input type="text" name="safety_observation_type" id="safety_observation_type"
                                            class="form-control" value="{{ $safety_observation_form->safety_observation_type }}"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Foto Temuan</label><br>
                                        <img src="{{ asset('storage/images/' . $safety_observation_form->image_id) }}"
                                            alt="Safety Observation Image" class="responsive-image">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Deskripsi Temuan</label>
                                        <textarea name="description" id="description" class="form-control" rows="3"
                                            readonly>{{ $safety_observation_form->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="hazard_potential">Potensi Bahaya</label>
                                        <input type="text" name="hazard_potential" id="hazard_potential"
                                            class="form-control" value="{{ $safety_observation_form->hazard_potential }}"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="impact">Dampak Bahaya</label>
                                        <input type="text" name="impact" id="impact" class="form-control"
                                            value="{{ $safety_observation_form->impact }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="short_term_recommendation">Rekomendasi Jangka Pendek</label>
                                        <input type="text" name="short_term_recommendation"
                                            id="short_term_recommendation" class="form-control"
                                            value="{{ $safety_observation_form->short_term_recommendation }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle_term_recommendation">Rekomendasi Jangka Menengah</label>
                                        <input type="text" name="middle_term_recommendation"
                                            id="middle_term_recommendation" class="form-control"
                                            value="{{ $safety_observation_form->middle_term_recommendation }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="long_term_recommendation">Rekomendasi Jangka Panjang</label>
                                        <input type="text" name="long_term_recommendation" id="long_term_recommendation"
                                            class="form-control" value="{{ $safety_observation_form->long_term_recommendation }}"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="completation_date">Target Tanggal Penyelesaian</label>
                                        <input type="text" name="completation_date" id="completation_date"
                                            class="form-control" value="{{ $safety_observation_form->completation_date }}"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="created_by">Created By</label>
                                        <input type="text" name="created_by" id="created_by" class="form-control"
                                            value="{{ $safety_observation_form->createdBy->name }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="reviewed_by">Reviewed By</label>
                                        <input type="text" name="reviewed_by" id="reviewed_by" class="form-control"
                                            value="{{ $safety_observation_form->reviewedBy ? $safety_observation_form->reviewedBy->name : '-' }}"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="approved_by">Approved By</label>
                                        <input type="text" name="approved_by" id="approved_by" class="form-control"
                                            value="{{ $safety_observation_form->approvedBy ? $safety_observation_form->approvedBy->name : '-' }}"
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" name="status" id="status" class="form-control"
                                            value="{{ $safety_observation_form->status }}" readonly>
                                    </div>

                                    <br>
                                    {{-- <footer class="footer">
                                        <!-- Footer content here -->
                                        <a href="{{ route('safety-observation-forms.edit', ['safety_observation_form' => $safety_observation_form->id]) }}" class="btn btn-primary">Edit</a>
                                    </footer> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
