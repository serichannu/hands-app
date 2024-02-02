<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaticsController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $subjects = Subject::all();

        $selectedSubject = $request->input('selectedSubject');

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $counterData = Counter::select('subject_id', 'student_id', 'date', DB::raw('SUM(count) as total_count'))
        ->whereHas('student', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->when($selectedSubject, function ($query) use ($selectedSubject) {
            $query->where('subject_id', $selectedSubject);
        })
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        })
        ->groupBy('subject_id', 'student_id', 'date')
        ->get();

        $studentsQuery = Student::where('user_id', $user->id);
        if ($request->has('search')) {
            $studentsQuery->where('number', $request->input('search'));
        }
        $students = $studentsQuery->get();

        return view('statics.index', compact('counterData', 'students', 'subjects', 'selectedSubject', 'startDate', 'endDate'));
    }
}
