<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MyPageController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('mypage.index', compact('user'));
    }


    public function destroy() {
        auth()->user()->delete();

        return redirect()->route('auth.login')->with('success', '※アカウントが削除されました。');
    }
}
