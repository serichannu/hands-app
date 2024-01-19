<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index() {
        return view('seats.index');
    }

    // public function assign() {
    //     return view('seats.assign');
    // }
    public function generateForm(Request $request) {

        $rows = $request->input('rows');
        $columns = $request->input('columns');
        $totalSeats = $rows * $columns;

        $students = Student::all();
        $studentsId = $students->pluck('number')->toArray();

        return view('seats.assign', compact('totalSeats', 'columns', 'rows', 'studentsId'));
    }

    public function assign(Request $request) {
        // 割り当て
        $seats = $request->input('seats');
        $studentsId = $request->input('studentsId');

        return redirect()->route('top.index')->with('success', '席の割り当てが完了しました');
    }
}
