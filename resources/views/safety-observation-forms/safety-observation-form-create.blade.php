@extends('layouts.app')

@section('content')
    <div>
        <h2>Create Safety Observation Form</h2>

        <form action="{{ route('safety-observation-forms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nomor_laporan">Nomor Laporan</label>
                <input type="text" name="nomor_laporan" id="nomor_laporan" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date_finding">Date Finding</label>
                <input type="date" name="date_finding" id="date_finding" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="location_id">Location</label>
                <select name="location_id" id="location_id" class="form-control" required>
                    <option value="">Select a location</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->location }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="safety_observation_type">Safety Observation Type</label>
                <select name="safety_observation_type" id="safety_observation_type" class="form-control" required>
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="unsafe_action">Unsafe Action</option>
                    <option value="unsafe_condition">Unsafe Condition</option>
                    <option value="bad_housekeeping">Bad Housekeeping</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="hazard_potential">Hazard Potential</label>
                <input type="text" name="hazard_potential" id="hazard_potential" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="impact">Impact</label>
                <input type="text" name="impact" id="impact" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="short_term_recommendation">Short Term Recommendation</label>
                <input type="text" name="short_term_recommendation" id="short_term_recommendation" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="middle_term_recommendation">Middle Term Recommendation</label>
                <input type="text" name="middle_term_recommendation" id="middle_term_recommendation" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="long_term_recommendation">Long Term Recommendation</label>
                <input type="text" name="long_term_recommendation" id="long_term_recommendation" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="completation_date">Completation Date</label>
                <input type="date" name="completation_date" id="completation_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="created_by">Created By</label>
                <select name="created_by" id="created_by" class="form-control" required>
                    <option value="">Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="approved_by">Approved By</label>
                <select name="approved_by" id="approved_by" class="form-control">
                    <option value="">Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
