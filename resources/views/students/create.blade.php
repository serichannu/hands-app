@extends('layouts.app')

@section('content')
    <div class="container">
        <h6 class="mt-3 mb-3">学生の出席番号を設定してください。</h6>

        <form action="{{ route('students.store') }}" method="POST" class="d-flex">
            @csrf
            <div class="form-group me-3">
                <label for="studentNum">学生の出席番号：</label>
                <select class="form-control" name="studentNum" id="studentNum" required>
                    @for ($i = 1; $i <= 40; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success mr-3 mt-4"><i class="fas fa-user-plus"></i>登録</button>
            </div>
        </form>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


        {{-- 学生のリスト表示 --}}
        @if ($students->count() > 0)
            <h6 class="mt-3 mb-3">登録済みの出席番号一覧</h6>
            <table class="table table-bordered w-25">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">出席番号</th>
                        <th scope="col" class="text-center">削除</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td id="num">{{ $student->number }}</td>
                            <td id="trash">
                                <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
