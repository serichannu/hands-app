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
    public function index(Request $request) {
        $counterData = Counter::select('subject_id', 'student_id', 'date', DB::raw('SUM(count) as total_count'))
        ->groupBy('subject_id', 'student_id', 'date')
        ->get();
        $studentsQuery = Student::query();
        $subjects = Subject::all();

        $searchTerm = $request->input('search');
        $selectedSubject = $request->input('selectedSubject');

        if ($searchTerm) {
            $studentsQuery->where('number', $searchTerm);
        }
        $students = $studentsQuery->get();

        return view('statics.index', compact('counterData', 'students', 'subjects', 'selectedSubject'));
    }
}
