<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticsController extends Controller
{
    public function index() {
        $counterData = Counter::select('subject_id', 'student_id', 'date', DB::raw('SUM(count) as total_count'))
        ->groupBy('subject_id', 'student_id', 'date')
        ->get();
        $students = Student::all();
        $subjects = Subject::all();


        return view('statics.index', compact('counterData', 'students', 'subjects'));
    }
}
