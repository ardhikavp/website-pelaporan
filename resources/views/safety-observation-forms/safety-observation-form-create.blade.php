@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('Safety Observation Form') }}</strong></div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                            <form action="{{ route('safety-observation-forms.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nomor_laporan">Nomor Laporan</label>
                                    <input type="text" name="nomor_laporan" id="nomor_laporan" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="date_finding">Tanggal Temuan</label>
                                    <input type="date" name="date_finding" id="date_finding" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="location_id">Lokasi</label>
                                    <select name="location_id" id="location_id" class="form-control" required>
                                        <option value="">Select a location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->location }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="safety_observation_type">Jenis Laporan</label>
                                    <select name="safety_observation_type" id="safety_observation_type" class="form-control" required>
                                        <option value="">Pilih Jenis Laporan</option>
                                        <option value="unsafe_action">Unsafe Action</option>
                                        <option value="unsafe_condition">Unsafe Condition</option>
                                        <option value="bad_housekeeping">Bad Housekeeping</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="image">Foto Temuan</label><br>
                                    <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Deskripsi Temuan</label>
                                    <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="hazard_potential">Potensi Bahaya</label>
                                    <input type="text" name="hazard_potential" id="hazard_potential" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="impact">Dampak Bahaya</label>
                                    <input type="text" name="impact" id="impact" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="short_term_recommendation">Rekomendasi Jangka Pendek</label>
                                    <input type="text" name="short_term_recommendation" id="short_term_recommendation" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="middle_term_recommendation">Rekomendasi Jangka Menengah</label>
                                    <input type="text" name="middle_term_recommendation" id="middle_term_recommendation" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="long_term_recommendation">Rekomendasi Jangka Panjang</label>
                                    <input type="text" name="long_term_recommendation" id="long_term_recommendation" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="completation_date">Target Tanggal Penyelesaian</label>
                                    <input type="date" name="completation_date" id="completation_date" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="created_by">Created By</label>
                                    <select name="created_by" id="created_by" class="form-control" disabled>
                                        <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>
                                    </select>
                                </div>


                                {{-- <div class="form-group">
                                    <label for="approved_by">Approved By</label>
                                    <select name="approved_by" id="approved_by" class="form-control">
                                        <option value="">Select a user</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <br>
                                <footer class="footer">
                                    <!-- Footer content here -->
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </footer>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
