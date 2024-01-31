@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <form class="mb-3">
            <div class="d-flex align-items-center">
                <!-- 教科選択 -->
                <p class="me-2 mt-3">教科選択：</p>
                <div class="me-2">
                    <select name="selectedSubject" id="subjectSelector" class="form-select">
                        <option value="">すべての教科</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                @if ($subject->id == $selectedSubject)
                                    selected
                                @endif>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- 検索ボタン -->
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>学生番号</th>
                    @foreach ($subjects as $subject)
                        <th>{{ $subject->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td id="studentTd" style="{{ $student->number % 2 == 0 ? 'background-color: #d1e0f9;' : '' }}">{{ $student->number }}</td>
                        @foreach ($subjects as $subject)
                            <td style="{{ $student->number % 2 == 0 ? 'background-color: #d1e0f9' : '' }}">
                                @php
                                    $foundCounter = $counterData->first(function ($counter) use ($student, $subject) {
                                        return $counter->student_id == $student->id && $counter->subject_id == $subject->id;
                                    });

                                    $totalCount = $foundCounter ? $foundCounter->total_count : 0;
                                @endphp

                                {{ $totalCount }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
