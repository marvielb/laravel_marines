<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Facades\Exam\ExamFacade;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exam.index');
    }

    public function getexamdetails(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|exists:exams'
        ]);

        return Exam::select(
            '*',
            DB::raw("(select COUNT(*) from exam_questions where exam_questions.exam_id = exams.id AND exam_questions.answer_id IS NULL) as remaining_questions"),
        )
            ->where('code', $validated['code'])
            ->with(['examinee.rank'])->first();
    }

    public function getquestion(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|exists:exams'
        ]);

        $exam = Exam::where('code', $validated['code'])
            ->first();

        $questions = ExamQuestion::where('exam_id', $exam['id'])
            ->with('question.choices')
            ->paginate(5);

        $remaining_questions = Exam::select(
            DB::raw("(select COUNT(*) from exam_questions where exam_questions.exam_id = exams.id AND exam_questions.answer_id IS NULL) as remaining_questions"),
        )
            ->where('code', $validated['code'])
            ->first();
        return [
            'questions' => $questions,
            'remaining_questions' => $remaining_questions['remaining_questions']
        ];
    }

    public function answerquestion(Request $request)
    {
        $validated = $request->validate([
            'answers.*.id' => 'required|exists:exam_questions,id',
            'answers.*.answer_id' => 'required|exists:choices,id'
        ]);

        foreach ($validated['answers'] as $exam) {
            ExamFacade::answerQuestion($exam['id'], $exam['answer_id']);
        }

        return $validated;
    }

    public function doneexam(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|exists:exams'
        ]);

        ExamFacade::finishExam($validated['code']);
    }
}
