@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fw-bold">{{ __('Safety Behavior Checklist') }}
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form action="{{ route('safety-behavior-checklist.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group fw-bold">
                                            <label for="user_id">Pelapor</label>
                                            <input type="text" name="user_id" id="user_id" class="form-control" value="{{ auth()->user()->name }}" required readonly>
                                        </div>
                                        <div class="form-group fw-bold">
                                            <label for="date_finding">Tanggal Temuan</label>
                                            <input type="date" name="date_finding" id="date_finding" class="form-control" required>
                                        </div>
                                        <div class="form-group fw-bold">
                                            <label for="operation_name">Nama Operasi</label>
                                            <div class="input-group">
                                                <select id="operation_name_select" class="form-control" style="width: 50%;">
                                                    <option value="">Select an option</option>
                                                    @foreach($operationNames as $operationName)
                                                        <option value="{{ $operationName }}">{{ $operationName }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" id="operation_name_input" class="form-control" placeholder="Search..." style="display: none; width: 50%;">
                                            </div>
                                            <input type="hidden" id="operation_name" name="operation_name">

                                            <button type="button" id="toggleInputButton" class="btn btn-secondary mt-2" data-toggle="input">Tambah Baru</button>
                                        </div>
                                        <div class="form-group  fw-bold" style="margin-bottom: 20px;">
                                            <label for="company">Perusahaan</label>
                                            <select name="company_id" id="company" class="form-control" required data-width="100%" data-target="#company" autocomplete="organization">
                                                <option value="">Pilih Perusahaan</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->company }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="table-responsive ">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                <tr>
                                                    <th style="width: 20%;" rowspan="2" class="align-middle text-center text-uppercase" >{{ __('Kategori') }}</th>
                                                    <th style="width: 70%;" rowspan="2" class="align-middle text-center text-uppercase">{{ __('Pertanyaan') }}</th>
                                                    <th style="width: 10%;"colspan="3" class="align-middle text-center text-uppercase">{{ __('Jawaban') }}</th>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Safe') }}</th>
                                                    <th>{{ __('Unsafe') }}</th>
                                                    <th>{{ __('N/A') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($safetyList as $checklist)
                                                    @php
                                                        $question_array = json_decode($checklist->question, true)['question'];
                                                        $keys = array_keys($question_array);
                                                        $first_index = $keys[0];
                                                    @endphp
                                                    @foreach (json_decode($checklist->question)->question as $key => $question)
                                                        <tr>
                                                            @php
                                                                if($first_index == $key) {
                                                                    echo '<td rowspan="' . count($question_array) . '">' . $checklist->category . '</td>';
                                                                }
                                                            @endphp
                                                            <td>
                                                                <div class="mb-3">
                                                                    <p class="mb-0">{{ $question }}</p>
                                                                    <input type="hidden"
                                                                        name="question[{{ $checklist->category }}][{{ $key }}]"
                                                                        value="{{ $question }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                    <div class="mb-3">
                                                                        <label>
                                                                            <input type="radio"
                                                                            name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                            value="safe">
                                                                        </label>
                                                                    </div>
                                                            </td>
                                                            <td>
                                                                    <div class="mb-3">
                                                                        <label>
                                                                            <input type="radio"
                                                                                name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                                value="unsafe">
                                                                        </label>
                                                                    </div>
                                                            </td>
                                                            <td>
                                                                    <div class="mb-3">
                                                                        <label>
                                                                            <input type="radio"
                                                                                name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                                value="n/a" checked>
                                                                        </label>
                                                                    </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
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
@pushOnce('body-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('operation_name_input');
        const select = document.getElementById('operation_name_select');
        const hiddenInput = document.getElementById('operation_name');
        const toggleButton = document.getElementById('toggleInputButton');

        input.style.display = 'none';

        toggleButton.addEventListener('click', function() {
            if (input.style.display === 'none') {
                input.style.display = 'block';
                select.style.display = 'none';
                hiddenInput.disabled = true;
                hiddenInput.value = '';
                toggleButton.innerText = 'Pilih Pekerjaan yang Telah Ada';
                toggleButton.setAttribute('data-toggle', 'select');
            } else {
                input.style.display = 'none';
                select.style.display = 'block';
                hiddenInput.disabled = false;

                if (hiddenInput.value.trim() !== '') {
                    select.value = hiddenInput.value;
                } else {
                    select.value = ''; // Reset the select value if hiddenInput is empty
                }

                toggleButton.innerText = 'Tambah Baru';
                toggleButton.setAttribute('data-toggle', 'input');
            }
        });

        select.addEventListener('change', function() {
            hiddenInput.value = select.value;
        });

        input.addEventListener('input', function() {
            hiddenInput.value = input.value;
        });
    });
</script>

@endPushOnce
@endsection

