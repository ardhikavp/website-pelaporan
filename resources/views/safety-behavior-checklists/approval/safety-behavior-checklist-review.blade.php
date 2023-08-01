@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Persetujuan Laporan Safety Behavior Checklist</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('safety-behavior-checklist.update-reviewed-by-pic', $answer->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="date_finding">Date Finding</label>
                                <input type="date" name="date_finding" id="date_finding" class="form-control"
                                    value="{{ $answer->date_finding }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="operation_name">Operation Name</label>
                                <input type="text" name="operation_name" id="operation_name" class="form-control"
                                    value="{{ $answer->operation_name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control" disabled>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            {{ $answer->company_id == $company->id ? 'selected' : '' }}>
                                            {{ $company->company }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="table-responsive ">
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
                                        <!-- ... Simpanan Data Answer ... -->
                                        @php
                                            $index = 0;
                                        @endphp
                                        @foreach ($safetyList as $checklist)
                                            @php
                                                $question_array = json_decode($checklist->question, true)['question'];
                                                $keys = array_keys($question_array);
                                                $first_index = $keys[0];
                                                $question_index = 0;
                                            @endphp
                                            @foreach (json_decode($checklist->question)->question as $key => $question)
                                                <tr>
                                                    @php
                                                        if ($first_index == $key) {
                                                            echo '<td rowspan="' . count($question_array) . '">' . $checklist->category . '</td>';
                                                        }
                                                    @endphp
                                                    <td>
                                                        <div class="mb-3">
                                                            <p class="mb-0">{{ $question }}</p>
                                                            <input type="hidden"
                                                                name="question[{{ $checklist->category }}][{{ $key }}]"
                                                                value="{{ $question }}" disabled>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <label>

                                                                <input type="radio"
                                                                    name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                    value="safe"
                                                                    {{ isset(json_decode($answer->answer)[$index]->question_answers[$question_index]->answer) && json_decode($answer->answer)[$index]->question_answers[$question_index]->answer === 'safe' ? 'checked' : '' }} disabled>
                                                                Safe
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <label>
                                                                <input type="radio"
                                                                    name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                    value="unsafe"
                                                                    {{ isset(json_decode($answer->answer)[$index]->question_answers[$question_index]->answer) && json_decode($answer->answer)[$index]->question_answers[$question_index]->answer === 'unsafe' ? 'checked' : '' }} disabled>
                                                                Unsafe
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="mb-3">
                                                            <label>
                                                                <input type="radio"
                                                                    name="answer[{{ $checklist->category }}][{{ $key }}]"
                                                                    value="n/a"
                                                                    {{ isset(json_decode($answer->answer)[$index]->question_answers[$question_index]->answer) && json_decode($answer->answer)[$index]->question_answers[$question_index]->answer === 'n/a' ? 'checked' : '' }} disabled>
                                                                N/A
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $question_index = $question_index + 1;
                                                @endphp
                                            @endforeach
                                            @php
                                                $index = $index + 1;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="form-group">
                                <label for="review_comment">Review Comment</label>
                                <textarea name="review_comment" id="review_comment" class="form-control" rows="3"
                                    placeholder="Komentar untuk feedback review"></textarea>
                            </div> --}}

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
@endsection
