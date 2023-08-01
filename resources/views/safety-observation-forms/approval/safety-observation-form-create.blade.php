@extends('layouts.app')

@section('content')
@pushOnce('head-scripts')
<style>
    .responsive-image {
        max-width: 50%;
        height: auto;
    }
</style>
@endPushOnce
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('safety-observation-forms.index') }}">Laporan Safety Observation</a></li>
                <li class="breadcrumb-item" aria-current="page">Buat Laporan</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>{{ __('Safety Observation Form') }}</strong></div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <form action="{{ route('safety-observation-forms.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="date_finding">Tanggal Temuan</label>
                                        <input type="date" name="date_finding" id="date_finding" class="form-control"
                                            required>
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
                                        <select name="safety_observation_type" id="safety_observation_type"
                                            class="form-control" required>
                                            <option value="">Pilih Jenis Laporan</option>
                                            <option value="unsafe_action">Unsafe Action</option>
                                            <option value="unsafe_condition">Unsafe Condition</option>
                                            <option value="bad_housekeeping">Bad Housekeeping</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Foto Temuan</label><br>
                                        <input type="file" name="image" id="image" class="form-control-file" accept="image/*" onchange="loadFile(event)">
                                        <input type="checkbox" id="jpegPreview" onchange="togglePreview()">
                                        <label for="jpegPreview">Show JPEG Preview</label>
                                        <br>
                                        <img id="output" class="responsive-image" style="display: none;">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Deskripsi Temuan</label>
                                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="hazard_potential">Potensi Bahaya</label>
                                        <input type="text" name="hazard_potential" id="hazard_potential"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="impact">Dampak Bahaya</label>
                                        <input type="text" name="impact" id="impact" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="short_term_recommendation">Rekomendasi Jangka Pendek</label>
                                        <input type="text" name="short_term_recommendation"
                                            id="short_term_recommendation" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="middle_term_recommendation">Rekomendasi Jangka Menengah</label>
                                        <input type="text" name="middle_term_recommendation"
                                            id="middle_term_recommendation" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="long_term_recommendation">Rekomendasi Jangka Panjang</label>
                                        <input type="text" name="long_term_recommendation" id="long_term_recommendation"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="completation_date">Target Tanggal Penyelesaian</label>
                                        <input type="date" name="completation_date" id="completation_date"
                                            class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="created_by">Created By</label>
                                        <input type="text" name="created_by" id="created_by" class="form-control"
                                            value="{{ auth()->user()->id }}" readonly>
                                    </div>

                                    {{-- NOT NEEDED SINCE DEFAULT VALUE IS PENDING_APPROVAL --}}
                                    {{-- <div class="form-group">
                                        <label for="approved_by">Approved By</label>
                                        <input type="text" name="approved_by" id="approved_by" class="form-control"
                                            value="{{ auth()->user()->id }}" readonly>
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @pushOnce('body-scripts')
    <script>
        var loadFile = function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.onload = function() {
                        // Resize the image to the desired percentage (50%)
                        var canvas = document.createElement('canvas');
                        var width = img.width * (50 / 100);
                        var height = img.height * (50 / 100);

                        canvas.width = width;
                        canvas.height = height;
                        var ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);

                        // Display the preview when the checkbox is checked
                        var output = document.getElementById('output');
                        output.src = canvas.toDataURL();
                        output.style.display = document.getElementById('jpegPreview').checked ? 'inline' : 'none';
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        };

        function togglePreview() {
            var jpegPreview = document.getElementById('jpegPreview').checked;
            var output = document.getElementById('output');

            // Show/hide the preview based on the checkbox value
            output.style.display = jpegPreview ? 'inline' : 'none';
        }
    </script>
    @endPushOnce
@endsection
