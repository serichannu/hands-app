<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Evaluation;
use App\Models\EvaluationCategory;
use App\Models\MyClass;
use App\Models\Seat;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use Symfony\Component\Console\Input\Input;

class TopController extends Controller
{
    public function index(Request $request) {
        $subjects = Subject::all();
        $selectedSubjectId = $request->input('subject_id');

        // 最新のクラス情報を取得
        $myClass = MyClass::where('user_id', '=', Auth::id())->latest()->first();
        $today = Carbon::today();
        $date = $today->format('Y-m-d');
        $knowledgeSkillCategory = EvaluationCategory::where('name', '=', '知・技' )->first();
        $thinkingJudgementExpressionCategory = EvaluationCategory::where('name', '=', '思・判・表' )->first();

        if ($myClass) {

            // ↑で取得した最新のクラス情報に紐づく座席情報を取得
            $seats = Seat::where('my_class_id', '=', $myClass->id)->with('student.counters')->get();

            // 座席情報をsequence(座席の並び順）をキーにした配列に置き換える
            $sequencedSeats = [];
            foreach ($seats as $seat) {
                $sequencedSeats[$seat->sequence] = $seat;
            }

            return view('tops.index', compact(
                'subjects',
                'myClass',
                'sequencedSeats',
                'selectedSubjectId',
                'date',
                'knowledgeSkillCategory',
                'thinkingJudgementExpressionCategory'
                ));

        } else {
            $message = '出席番号登録と席替えから座席の登録をしてください。';
            return view('tops.index', compact(
                'subjects',
                'myClass',
                'message',
                'knowledgeSkillCategory',
                'thinkingJudgementExpressionCategory'
                ));

        }
    }


    public function changeCounter(Request $request) {
        $studentId = $request->input('student_id');
        $subjectId = $request->input('subject_id');
        $type = $request->input('type');
        $evaluationCategoryId = $request->input('evaluation_category_id');
dd($request->all());

        $today = Carbon::today();
        $date = $today->format('Y-m-d');
        $countValue = $type == 'increment' ? DB::raw('count + 1') : DB::raw('count - 1');
        $counter = Counter::updateOrCreate(
            ['student_id' => $studentId, 'subject_id' => $subjectId, 'date' => $date],
            ['count' => $countValue]
        );
// dd($counter);
dd($evaluationCategoryId);

        if ($evaluationCategoryId) {
            Evaluation::updateOrCreate(
                ['counter_id' => $counter->id, 'evaluation_category_id' => $evaluationCategoryId],
                ['count' => DB::raw('count + 1')],
            );
        }

        return redirect()->back();
    }

}
