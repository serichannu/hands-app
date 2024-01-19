@extends('layouts.app')

@section('content')
    <div class="container mb-1 mt-2">
        <div class="d-flex align-items-center">
            <p class="mt-3" id="currentDate">{{ now()->toDateString() }}</p>
            <button id="openDatePicker" class="btn btn-light ms-3"><i class="far fa-calendar-alt"></i> 日付変更</button>
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
    </div>


    <!-- モーダル -->
    <div class="modal fade" id="datePickerModal" tabindex="-1" aria-labelledby="datePickerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datePickerModalLabel">日付を選択してください</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="datepicker" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">決定</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Flatpickr
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                onClose: function (selectedDates, dateStr) {
                    // 日付選択
                    console.log(dateStr);
                    // 日付の表示更新
                    document.getElementById('currentDate').textContent = dateStr;
                }
            });

            // モーダル
            document.getElementById('openDatePicker').addEventListener('click', function () {
                var myModal = new bootstrap.Modal(document.getElementById('datePickerModal'));
                myModal.show();
            });

            // セレクタ
            document.getElementById('subjectSelector').addEventListener('change', function () {
                let selectedSubject = this.value;
                document.getElementById('selectedSubject').textContent = selectedSubject;
            });
        });
    </script>
@endsection
