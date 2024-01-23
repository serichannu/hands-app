@extends('layouts.app')

@section('content')
    <div class="container">
        <h6 class="mt-3 mb-3">学生の人数（出席番号）を設定</h6>

        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="studentNum">学生の人数：</label>
                <select class="form-control w-25 mb-3" name="studentNum" id="studentNum" required>
                    @for ($i = 1; $i <= 40; $i++)
                        <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success mr-3"><i class="far fa-save"></i>保存</button>
                {{-- <a href="{{ route('students.edit') }}" class="btn btn-primary" style="margin-left: 30px;">
                    <i class="far fa-edit"></i>編集
                </a> --}}
            </div>
        </form>
    </div>

@endsection
