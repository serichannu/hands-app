<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function index() {
        return view('mypage.index');
    }

    public function update() {
        return view('mypage.update');
    }

    public function destroy() {
        return view('mypage.destroy');
    }
}
