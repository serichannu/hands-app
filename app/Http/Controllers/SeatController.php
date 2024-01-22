<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MyClass;
use App\Models\Seat;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeatController extends Controller
{
    public function showSeat() {
        return view('seats.index');
    }

    public function storeSeat(Request $request) {
        $rows = $request->input('rows');
        $columns = $request->input('columns');
        $totalSeats = $rows * $columns;

        // DB登録
        $myClass = new MyClass();
        $myClass->row = $request->input('rows');
        $myClass->column = $request->input('columns');
        $myClass->user_id = Auth::id();
        $myClass->save();

        return redirect()->route('seats.assign', ['id' => $myClass->id])->with([
            'totalSeats' => $totalSeats,
            'columns' => $columns,
            'rows' => $rows,
        ] );
    }

    public function showAssign($id) {
        $myClass = MyClass::findOrFail($id);

        $totalSeatNum = $myClass->row * $myClass->column;

        $students = Student::where('user_id', '=', Auth::id())->get();
        // $studentsId = $students->pluck('number')->toArray();


        return view('seats.assign', [
            'totalSeatNum' => $totalSeatNum,
            'rows' => $myClass->row,
            'columns' => $myClass->column,
            // 'studentsId' => $studentsId,
            'students' => $students,
        ]);
    }

    public function storeAssign(Request $request)
    {
        // $myClass = MyClass::findOrFail($request->input('my_class_id'));
        $myClass = MyClass::where('user_id', '=', Auth::id())->latest()->first();
        $totalSeatNum = $myClass->row * $myClass->column;
        for ($i = 0; $i < $totalSeatNum; $i++) {
            if ($request->filled('student_id_'.$i)) {
                $sequence = $request->input('sequence_'.$i);
                $studentId = $request->input('student_id_'.$i);

                $seat = new Seat();
                $seat->my_class_id = $myClass->id;
                $seat->student_id = $studentId;
                $seat->sequence = $sequence;
                $seat->save();
            }
        }

        return redirect()->route('tops.index')->with('success', '席の割り当てが完了しました');
    }

    }


