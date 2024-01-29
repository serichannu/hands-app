<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MyClass;
use App\Models\Seat;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index() {
        $subjects = Subject::all();

        // 最新のクラス情報を取得
        $myClass = MyClass::where('user_id', '=', Auth::id())->latest()->first();

        if ($myClass) {

        // ↑で取得した最新のクラス情報に紐づく座席情報を取得
        $seats = Seat::where('my_class_id', '=', $myClass->id)->with('student')->get();

        // 座席情報をsequence(座席の並び順）をキーにした配列に置き換える
        $sequencedSeats = [];
        foreach ($seats as $seat) {
            $sequencedSeats[$seat->sequence] = $seat;
        }

        return view('tops.index', compact('subjects', 'myClass', 'sequencedSeats'));

        } else {
            $message = '出席番号登録と席替えから座席の登録をしてください。';
            return view('tops.index', compact('subjects', 'myClass', 'message'));

        }
    }


    public function incrementCounter(Request $request) {
        $studentId = $request->input('student_id');
        $value = $request->input('value');

        // 仮のセッションキーを使用してセッション内にカウンターを保存する例
        $counterKey = 'counter_' . $studentId;

        $counter = $request->session()->get($counterKey, 0);
        $request->session()->put($counterKey, $counter + $value);
        return redirect()->back();

    }

    public function decrementCounter(Request $request) {
        $studentId = $request->input('student_id');
        $value = $request->input('value');
        // 仮のセッションキーを使用してセッション内にカウンターを保存する例
        $counterKey = 'counter_' . $studentId;

        $counter = $request->session()->get($counterKey, 0);
        $request->session()->put($counterKey, max(0, $counter - abs($value)));
        return redirect()->back();

    }
}
