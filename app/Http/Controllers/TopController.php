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

        // ↑で取得した最新のクラス情報に紐づく座席情報を取得
        $seats = Seat::where('my_class_id', '=', $myClass->id)->with('student')->get();

        // 座席情報をsequence(座席の並び順）をキーにした配列に置き換える
        $sequencedSeats = [];
        foreach ($seats as $seat) {
            $sequencedSeats[$seat->sequence] = $seat;
        }

        return view('tops.index', compact('subjects', 'myClass', 'sequencedSeats'));
    }


    public function store(Request $request) {

    //     $counter = new Counter();
    //     $counter->student_id = ;
    //     $counter->subject_id = ;
    //     $counter->date

    // }
    }
}
