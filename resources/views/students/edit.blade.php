@extends('layouts.app')

@section('content')
<div class="container">
    <h6 class="mt-3 mb-3">学生の人数（出席番号）を編集</h6>

    <form action="{{ route('students.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="studentNum">学生の人数：</label>
            <select class="form-control w-25 mb-3" name="studentNum" id="studentNum" required>
                @for ($i = 1; $i <= 40; $i++)
                    <option value="{{ $i }}">{{ $i }}人</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-secondary mb-3">更新</button>
    </form>

@endsection
