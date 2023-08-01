@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Safety Behavior Checklist</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('safety-behavior-checklist.show', $answer->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nomor_laporan">Nomor Laporan</label>
                                <input type="text" name="nomor_laporan" id="nomor_laporan" class="form-control"
                                    value="{{ $answer->nomor_laporan }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="date_finding">Date Finding</label>
                                <input type="date" name="date_finding" id="date_finding" class="form-control"
                                    value="{{ $answer->date_finding }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="operation_name">Operation Name</label>
                                <input type="text" name="operation_name" id="operation_name" class="form-control"
                                    value="{{ $answer->operation_name }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control" readonly>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ $answer->company_id == $company->id ? 'selected' : '' }}>
                                            {{ $company->company }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%;" rowspan="2"
                                                class="align-middle text-center text-uppercase">{{ __('Kategori') }}</th>
                                            <th style="width: 70%;" rowspan="2"
                                                class="align-middle text-center text-uppercase">{{ __('Pertanyaan') }}</th>
                                            <th style="width: 10%;"colspan="3"
                                                class="align-middle text-center text-uppercase">{{ __('Jawaban') }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Safe') }}</th>
                                            <th>{{ __('Unsafe') }}</th>
                                            <th>{{ __('N/A') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (json_decode($answer->answer) as $tes)
                                            @php
                                                $counter = 0;
                                            @endphp
                                            @foreach ($tes->question_answers as $key => $value)
                                                <tr>
                                                    @php
                                                        if ($counter == 0) {
                                                            echo '<td rowspan="' . count($tes->question_answers) . '">' . $tes->category . '</td>';
                                                        }
                                                        $counter = $counter + 1;
                                                    @endphp
                                                    <td>
                                                        <div class="mb-3">
                                                            <p class="mb-0">{{ $value->question }}</p>
                                                            <input type="hidden"
                                                                name="question[{{ $tes->category }}][{{ $value->question_id }}]"
                                                                value="{{ $value->question }}" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <label>
                                                                <input type="radio"
                                                                    name="answer[{{ $tes->category }}][{{ $value->question_id }}]"
                                                                    value="safe"
                                                                    {{ isset($value->answer) && $value->answer === 'safe' ? 'checked' : '' }} disabled>

                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <label>
                                                                <input type="radio"
                                                                    name="answer[{{ $tes->category }}][{{ $value->question_id }}]"
                                                                    value="unsafe"
                                                                    {{ isset($value->answer) && $value->answer === 'unsafe' ? 'checked' : '' }} disabled>

                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <label>
                                                                <input type="radio"
                                                                    name="answer[{{ $tes->category }}][{{ $value->question_id }}]"
                                                                    value="n/a"
                                                                    {{ isset($value->answer) && $value->answer === 'n/a' ? 'checked' : '' }} disabled>

                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <div class="form-group">
                            <a class="btn btn-primary" href="{{ route('safety-behavior-checklist.edit', $answer->id) }}">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
