@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <form class="mb-3">
            <div class="d-flex align-items-center">
                <!-- 教科選択 -->
                <p class="mt-3">教科選択：</p>
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

                {{-- 期間選択 --}}
                <div class="me-2" style="display: flex; align-items: center; white-space: nowrap;">
                    <label for="startDate" class="me-1">開始日：</label>
                    <input type="date" id="startDate" name="startDate" class="form-control" value="{{ $startDate }}">
                </div>

                <div class="me-2" style="display: flex; align-items: center; white-space: nowrap;">
                    <label for="endDate" class="me-1">終了日：</label>
                    <input type="date" id="endDate" name="endDate" class="form-control" value="{{ $endDate }}">
                </div>

                <!-- 検索ボタン -->
                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i>検索</button>
            </div>
        </form>

        <table class="fas_table_colrowheader">
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
                    <td id="studentTd" style="{{ $student->number % 2 == 0 ? 'background-color: #f5f5f5;' : '' }}">{{ $student->number }}</td>
                    @foreach ($subjects as $subject)
                        <td style="{{ $student->number % 2 == 0 ? 'background-color: #f5f5f5' : '' }}">
                            @php
                                $totalCount = $counterData
                                    ->where('student_id', $student->id)
                                    ->where('subject_id', $subject->id)
                                    ->sum('total_count');
                                $temp = $evaluationData
                                    ->where('student_id', $student->id)
                                    ->where('subject_id', $subject->id);
                                $result = [];
                                foreach ($temp as $t) {
                                    $evaluations = $t->evaluations;
                                    foreach ($evaluations as $evaluation) {
                                        $result[$evaluation->evaluation_category->name] = $evaluation->count;
                                    }
                                }
                            @endphp

                            {{ $totalCount }}
                            @foreach ($result as $name => $count)
                                <br>{{ $name.":".$count }}
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            @endforeach
                        </tbody>
        </table>
    </div>
@endsection
