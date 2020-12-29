<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exam;

class ExamResultController extends Controller
{
    public function index(Request $request, $exam_code)
    {
        return view('exam.result', ['exam_code' => $exam_code]);
    }

    public function getexamresults(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|exists:exams'
        ]);

        $exam = Exam::where('code', $validated['code'])
            ->with(['examinee.rank'])
            ->first();

        $examResults = DB::table('exam_questions')
            ->select(
                DB::raw('COUNT(*) AS total_items'),
                DB::raw('
                        SUM(
                        CASE WHEN answer_id = (SELECT correct_choice_id FROM questions WHERE id = exam_questions.question_id)
                            THEN 1
                            ELSE 0
                        END
                        ) AS correct_answers')
            )->where('exam_id', $exam['id'])->first();

        $examResultGroupings = DB::table('exam_questions')
            ->select(
                DB::raw('question_classifications.description'),
                DB::raw('COUNT(*) as total_items'),
                DB::raw('SUM(
                        CASE WHEN answer_id = (SELECT correct_choice_id FROM questions WHERE id = exam_questions.question_id)
                            THEN 1
                            ELSE 0
                        END) AS correct_answers')
            )
            ->join('questions', 'exam_questions.question_id', '=', 'questions.id')
            ->join('question_classifications', 'questions.classification_id', '=', 'question_classifications.id')
            ->where('exam_id', $exam['id'])
            ->groupBy('questions.classification_id')
            ->get();

        return [
            'exam_result_grouped' => $examResultGroupings->toArray(),
            'total_items' => (int)$examResults->total_items,
            'correct_answers' => (int)$examResults->correct_answers,
            'exam' => $exam,
        ];
    }
}
