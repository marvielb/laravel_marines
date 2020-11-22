<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'marine_number' => 'required|exists:users,marine_number'
        ]);

        $exam = Exam::generate($validated['marine_number']);
        return $exam;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }

    public function confirm()
    {
        return view('exam.confirm');
    }

    public function result(Request $request, $exam_code)
    {
        return view('exam.result', ['exam_code' => $exam_code]);
    }

    public function proceed(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|exists:exams'
        ]);

        Session::put('active_exam_code', $validated['code']);

        $exam = Exam::where('code', $validated['code'])->first();
        if (!$exam->started_at) {
            $exam->started_at = Carbon::now();
            $exam->save();
        }
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
            $examQuestion = ExamQuestion::find($exam['id']);
            $examQuestion->answer_id = $exam['answer_id'];
            $examQuestion->save();
        }

        return $validated;
    }

    public function doneexam(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|exists:exams'
        ]);

        $exam = Exam::where('code', $validated['code'])
            ->first();

        $exam->finished_at = Carbon::now();
        $exam->save();
    }

    public function getexamresults(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|exists:exams'
        ]);

        $exam = Exam::where('code', $validated['code'])
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

        return [
            'total_items' => (int)$examResults->total_items,
            'correct_answers' => (int)$examResults->correct_answers,
            'exam' => $exam,
        ];
    }
}
