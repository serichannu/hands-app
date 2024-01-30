@extends('layouts.app')

@section('content')
<div class="container mb-1 mt-2">
    <div class="d-flex align-items-center">
        <p class="mt-3" id="currentDate">{{ now()->toDateString() }}</p>
        <p class="mt-3 ms-3">教科：</p>
        {{-- 教科情報の表示 --}}
        @if(isset($selectedSubject))
            <p class="mt-3 ms-1">{{ $selectedSubject->name }}</p>
        @else
            <p class="mt-3 ms-1">未選択</p>
        @endif

        {{-- セレクタとボタンを横並びにするコンテナ --}}
        <div class="d-flex align-items-center ms-3">
            {{-- セレクタ --}}
            <form class="d-flex align-items-center">
                <select name="subject_id" id="subjectSelector" class="form-select">
                    <option value="">選択してください</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            @if ($subject->id == $selectedSubjectId)
                                selected
                            @endif>{{ $subject->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary ms-1" id="submitButton">表示</button>
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
                                            <button class="btn btn-primary" id="countUp" type="submit">＋</button>
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
                                            <button class="btn btn-danger" id="countDown" type="submit">－</button>
                                        </form>
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

    {{-- <script>
            // セレクタ
            document.getElementById('subjectSelector').addEventListener('change', function () {
                let selectedSubject = this.value;
                document.getElementById('selectedSubject').textContent = selectedSubject;
            });
    </script> --}}
@endsection
