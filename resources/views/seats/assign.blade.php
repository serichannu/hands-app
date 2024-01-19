@extends('layouts.app')

@section('content')
    <div class="container">
        <h6 class="mt-3 mb-0">出席番号を割り当ててください。</h6>

        <!-- 学生IDの割り当てフォーム -->
        <form action="{{ route('seats.assign') }}" method="post" onsubmit="return validateForm()">
            @csrf
            <!-- 生成された席の数の入力欄 -->
            <div class="seat-container mt-3 mb-3">
                @for ($i = 1; $i <= $totalSeats; $i++)
                <div class="seat">
                    <label for="seat_{{ $i }}" class="form-label"></label>
                    <input type="number" class="form-control" id="seat_{{ $i }}" name="seats[{{ $i }}]" min="1" max="40">
                    <input type="hidden" name="student_ids[{{ $i }}]" value="{{ $studentsId[$i]?? '' }}">
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
            var inputs = document.querySelectorAll('[name^="seats["]');

            for (var i = 0; i < inputs.length; i++) {
                var seatNumber = inputs[i].value;
                if(seatNumber.trim() !== '') {
                    if (selectedNumbers.has(seatNumber)) {
                    alert('番号が重複しています。');
                    return false;
                }
                selectedNumbers.add(seatNumber);

                }
            }
            return true;
        }
    </script>
@endsection
