@extends('layouts.app')

@section('content')
    <div class="container">
        <h6 class="mt-3 mb-0">出席番号を割り当ててください。</h6>

        <!-- 学生IDの割り当てフォーム -->
        <form action="{{ route('seats.assign.store') }}" method="post" onsubmit="return validateForm()">
            @csrf
            <!-- 生成された席に学生番号を入力する欄 -->
            <div class="seat-container mt-3 mb-3">
                @for ($i = 0; $i < $totalSeatNum; $i++)
                <div class="seat">
                    <label for="seat_{{ $i }}" class="form-label"></label>
                    <input type="hidden"  id="sequence{{ $i }}" name="sequence_{{ $i }}" value="{{ $i }}">
                    <select name="student_id_{{ $i }}" id="">
                        <option value=""></option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->number }}</option>
                        @endforeach
                    </select>
                </div>
                @endfor
            </div>

            <button type="submit" class="btn btn-secondary mb-3" id="assignBtn">登録</button>
        </form>
    </div>
    <style>
        .seat-container {
            display: grid;
            grid-template-columns: repeat({{$columns}}, 1fr); /* 列の数を指定 */
            gap: 10px; /* 隣接する席の間隔 */
        }

        .seat {
            /* 席のスタイルを適切に調整 */
            width: 60px; /* 席の横幅 */
            height: 60px; /* 席の縦幅 */
            border: 1px solid #ccc; /* 席のボーダー */
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
<script>
    function validateForm() {
        var selectedNumbers = new Set();
        var selects = document.querySelectorAll('select[name^="student_id_"]');

        var allEmpty = true;  // すべてのセレクトボックスが空欄かどうかのフラグ

        for (var i = 0; i < selects.length; i++) {
            var seatNumber = selects[i].value;

            if (seatNumber.trim() !== '') {
                allEmpty = false;  // 少なくとも1つのセレクトボックスが選択されている
                if (selectedNumbers.has(seatNumber)) {
                    alert('番号が重複しています。');
                    return false;
                }
                selectedNumbers.add(seatNumber);
            }
        }

        if (allEmpty) {
            alert('少なくとも1つの学生を選択してください。');
            return false;
        }

        return true;
    }
</script>
@endsection
