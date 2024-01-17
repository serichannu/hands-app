@extends('layouts.app')

@section('content')
<p id="currentDate">{{ now()->toDateString() }}</p>

<button id="openDatePicker"><i class="far fa-calendar-alt"></i>日付変更</button>

<!-- Modal -->
<div class="modal fade" id="datePickerModal" tabindex="-1" aria-labelledby="datePickerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="datePickerModalLabel">Select Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="datepicker">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Flatpickr
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr) {
                // Handle the selected date
                console.log(dateStr);
                // You can also update the displayed date on the page
                document.getElementById('currentDate').textContent = dateStr;
            }
        });

        // Open the date picker modal
        document.getElementById('openDatePicker').addEventListener('click', function () {
            var myModal = new bootstrap.Modal(document.getElementById('datePickerModal'));
            myModal.show();
        });
    });
</script>
@endsection
