@extends('layouts.app')

@section('content')
    <div class="container mt-2">
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
