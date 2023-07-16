@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Safety Behavior Checklist') }}
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form action="{{ route('safety-behavior-checklist.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="user_id">Pelapor</label>
                                            <input type="text" name="user_id" id="user" class="form-control"
                                                value="{{ auth()->user()->name }}" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="operation_name">Nama Operasi</label>
                                            <input type="text" name="operation_name" id="answer" class="form-control"
                                                value="" required>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="company_id">Perusahaan</label>
                                            <select name="company_id" id="company" class="form-control" required
                                                data-width="100%">
                                                <option value="">Pilih Perusahaan</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->company }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Category') }}</th>
                                                    <th>{{ __('Question') }}</th>
                                                    <th>{{ __('Answer') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($safetyList as $checklist)
                                                    <tr>
                                                        <td>{{ $checklist->category }}</td>
                                                        <td>
                                                            @foreach (json_decode($checklist->question)->question as $key => $question)
                                                                <div class="mb-3">
                                                                    <p class="mb-0">{{ $question }}</p>
                                                                    <input type="hidden"
                                                                        name="question[{{ $checklist->category }}][{{ $key }}]"
                                                                        value="{{ $question }}">
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach (json_decode($checklist->question)->question as $key => $question)
                                                                <div class="mb-3">
                                                                    <label>
                                                                        <input type="radio"
                                                                            name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                            value="yes">
                                                                        <span>{{ __('Yes') }}</span>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio"
                                                                            name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                            value="no">
                                                                        <span>{{ __('No') }}</span>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio"
                                                                            name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                            value="n/a" checked>
                                                                        <span>{{ __('N/A') }}</span>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
    <script>
        $(document).ready(function() {
            $('#company').select2();
        });
    </script>
@endsection
