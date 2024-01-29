@extends('layouts.app')

@section('content')
    <div class="container mb-1 mt-2">
        <div class="d-flex align-items-center">
            <p class="mt-3" id="currentDate">{{ now()->toDateString() }}</p>
            <p class="mt-3 ms-3">教科：<span id="selectedSubject"></span></p>

            {{-- セレクタ --}}
            <select name="" id="subjectSelector" class="form-select ms-3">
                <option value="">選択してください</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                @endforeach
            </select>

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

    @if ($myClass)
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
                                    <form action="{{ route('increment-counter') }}" method="POST" style="display: inline">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $sequencedSeats[$seq]->student->id }}">
                                        <input type="hidden" name="value" value="1">
                                        <button class="btn btn-primary" id="countUp" type="submit">＋</button>
                                    </form>

                                    <span id="counter{{ $sequencedSeats[$seq]->student->id }}">
                                        {{ session('counter_' . $sequencedSeats[$seq]->student->id, 0) }}
                                    </span>

                                    <form action="{{ route('decrement-counter') }}" method="POST" style="display: inline">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $sequencedSeats[$seq]->student->id }}">
                                        <input type="hidden" name="value" value="-1">
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
    @else
    <div class="container">
        <div class="alert alert-success">
            {{ $message }}
        </div>
    </div>
    @endif

    <script>
            // セレクタ
            document.getElementById('subjectSelector').addEventListener('change', function () {
                let selectedSubject = this.value;
                document.getElementById('selectedSubject').textContent = selectedSubject;
            });
    </script>
@endsection
