<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function create() {
        $students = Student::where('user_id', Auth::id())->get();
        return view('students.create', [
            'students' => $students]);
    }

    public function store(Request $request) {
        $request->validate([
            'studentNum' => 'required|numeric|min:1|max:40',
        ]);

        $studentNum = $request->input('studentNum');

            $student = new Student();
            $student->number = $studentNum;
            $student->user_id = Auth::id();
            $student->save();

        return redirect()->back()->with('success', '学生の出席番号 ' . $student->number . ' を追加しました。');
    }


    public function destroy(Student $student) {
        $student->delete();
        return redirect()->back()->with('error', '学生の出席番号 ' . $student->number . ' を削除しました。');
    }
}
