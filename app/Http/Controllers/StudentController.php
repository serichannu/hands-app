<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index() {
        return view('students.index');
    }

    public function store(Request $request) {
        $request->validate([
            'studentNum' => 'required|numeric|min:1|max:40',
        ]);

        $studentNum = $request->input('studentNum');

        for ($i = 1; $i <= $studentNum; $i++) {
            $student = new Student();
            $student->number = $i;
            $student->user_id = Auth::id();
            $student->save();
        }
        return redirect()->route('seats.index')->with('success', '学生の人数(出席番号）の設定が完了しました。');
    }
}
