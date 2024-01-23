<!-- resources/views/seating/index.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <div class="text-center" id="border-box">
        <h6 class="mt-2 mb-4">座席の配列を入力してください。</h6>


        <!-- 縦×横のフォーム -->
        <form action="{{ route('seats.store') }}" method="post" class="form-inline">
            @csrf
            <div class="d-flex justify-content-center">
                <div class="me-3">
                    <label for="rows" class="form-label">縦の席数</label>
                    <input type="number" class="form-control" id="rows" name="rows" required min="1" max="5">
                </div>
                <span class="spanTimes me-3"><i class="fas fa-times"></i></span>
                <div>
                    <label for="columns" class="form-label">横の席数</label>
                    <input type="number" class="form-control" id="columns" name="columns" required min="1" max="8">
                </div>
            </div>
            <button type="submit" class="btn btn-secondary mb-3">登録</button>
        </form>
    </div>
</div>
@endsection
