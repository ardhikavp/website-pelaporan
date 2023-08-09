@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2>Upload Finish Report PDF</h2>
        <form action="{{ route('progress.so.uploaded', ['id' => $form->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pdf_file">Upload PDF File:</label>
                <input type="file" name="pdf_file" id="pdf_file" accept=".pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
