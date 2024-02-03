@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center mt-3">
        <h5 class="border-bottom border-3 p-3">マイページ</h5>

        <div class="mt-5 mb-5">
            <form action="{{ route('mypage.destroy') }}" method="POST" onsubmit="return confirm('本当にアカウントを削除しますか？')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" id="deleteAccountBtn">アカウント削除</button>
            </form>
        </div>
    </div>
</div>
@endsection
