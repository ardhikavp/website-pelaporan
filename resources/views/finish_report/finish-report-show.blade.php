@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <embed src="{{ asset('storage/' . $form->finish_report_path) }}" type="application/pdf" width="100%" height="500px">
    </div>
@endsection
