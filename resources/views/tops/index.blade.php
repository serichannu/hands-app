@extends('layouts.app')

@section('content')
<div class="container mb-1 mt-2">
    <div class="d-flex align-items-center">
        <p class="mt-3" id="currentDate">{{ now()->toDateString() }}</p>

        {{-- セレクタとボタンを横並びにするコンテナ --}}
        <div class="d-flex align-items-center ms-3">
            {{-- セレクタ --}}
            <form class="d-flex align-items-center">
                <select name="subject_id" id="subjectSelector" class="form-select">
                    <option value="">選択してください</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                @if(isset($selectedSubjectId) && $selectedSubjectId === $subject->id)
                                    selected
                                @endif>{{ $subject->name }}</option>
                        @endforeach
                </select>
                <button type="submit" class="btn btn-secondary ms-1" id="submitButton"><i class="fas fa-desktop"></i>
                    表示</button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger">
            {{ session('error_message') }}
        </div>
    @endif
</div>


    {{-- 座席情報 --}}

    @if ($myClass && $selectedSubjectId)
        <div class="container mb-3">
            <table>
                @for ($r = 0; $r < $myClass->row; $r++)
                    <tr>
                        @for ($c = 0; $c < $myClass->column; $c++)
                            @php
                                $seq = $r * $myClass->column + $c;
                            @endphp
                            <td class="mt-2">
                                @if (isset($sequencedSeats[$seq]))
                                    出席番号：{{ $sequencedSeats[$seq]->student->number }}
                                    {{-- カウンター --}}
                                    <div class="counter-container mt-2 mb-2">
                                        <form action="{{ route('change-counter') }}" method="POST" style="display: inline">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $sequencedSeats[$seq]->student->id }}">
                                            <input type="hidden" name="subject_id" value="{{ $selectedSubjectId }}">
                                            <input type="hidden" name="type" value="increment">
                                            <input type="hidden" name="evaluation_category_id" class="evaluation_category_id">
                                            <button class="btn" id="countUp" type="submit">＋</button>
                                        </form>

                                        <span id="counter{{ $sequencedSeats[$seq]->student->id }}">
                                            @php
                                                $counter = $sequencedSeats[$seq]->student->counters
                                                    ->where('subject_id', '=', $selectedSubjectId)
                                                    ->where('date', '=', $date)
                                                    ->first();
                                            @endphp
                                            {{ is_null($counter) ? 0 : $counter->count }}
                                        </span>

                                        <form action="{{ route('change-counter') }}" method="POST" style="display: inline">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $sequencedSeats[$seq]->student->id }}">
                                            <input type="hidden" name="subject_id" value="{{ $selectedSubjectId }}">
                                            <input type="hidden" name="type" value="decrement">
                                            <input type="hidden" name="evaluation_category_id" class="evaluation_category_id">
                                            <button class="btn" id="countDown" type="submit">－</button>
                                        </form>

                                    {{-- 評価ボタン --}}
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input knowledgeSkill" type="radio" id="knowledgeSkill_{{ $sequencedSeats[$seq]->student->id }}">
                                                <label class="form-check-label" for="knowledgeSkill_{{ $sequencedSeats[$seq]->student->id }}">知・技</label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input thinkingJudgementExpression" type="radio" id="thinkingJudgementExpression_{{ $sequencedSeats[$seq]->student->id }}">
                                                <label class="form-check-label" for="thinkingJudgementExpression_{{ $sequencedSeats[$seq]->student->id }}">思・判・表</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>
    @elseif (isset($message))
        <div class="container">
            <div class="alert alert-success">
                {{ $message }}
            </div>
        </div>
    @endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('input[type="radio"]').click(function() {
        // 他の<td>内のラジオボタンを選択解除
        $('input[type="radio"]').not(this).prop('checked', false);

        let parent = $(this).closest('td');

// console.log(parent.find('.evaluation_category_id'));
        if ($(this).is('.knowledgeSkill')) {
            parent.find('.evaluation_category_id').each(function() {
                $(this).val({{ $knowledgeSkillCategory->id }});
            });
            // console.log("knowledgeSkill処理済み");

        } else if ($(this).is('.thinkingJudgementExpression')) {
            parent.find('.evaluation_category_id').val({{ $thinkingJudgementExpressionCategory->id }});
            // console.log("thinkingJudgementExpression処理済み");

        }

    });
});
</script>
@endsection
