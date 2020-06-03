<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionGroup;
use App\QuestionGroupQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pager;

class QuestionGroupQuestionController extends Controller
{
    use Pager;

    public function tableName()
    {
        return 'question_group_questions';
    }

    //Overriden from pager
    public function Pagination($questiongroupid)
    {
        $mod_query = $this->query()
                          ->join('questions', 'question_group_questions.question_id', '=', 'questions.id')
                          ->where('question_group_questions.question_group_id','=', $questiongroupid)
                          ->select('questions.*');
        return $this->Paginate($mod_query);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionGroup $questiongroup)
    {
        return view('questiongroup.question.index', ['questiongroup' => $questiongroup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionGroup $questiongroup)
    {
        return DB::table('questions')->whereNotExists(function ($query) use ($questiongroup) {
            $query->select(DB::raw(1))
                  ->from('question_group_questions')
                  ->whereRaw('question_group_questions.question_id = questions.id')
                  ->where('question_group_questions.question_group_id', '=', $questiongroup['id']);
        })->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, QuestionGroup $questiongroup)
    {
        $validatedRequest = $request->validate([
            'question_id' => 'required|exists:questions,id'
        ]);
        $validatedRequest['question_group_id'] = $questiongroup['id'];
        return QuestionGroupQuestion::create($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionGroupQuestion  $questionGroupQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionGroupQuestion $questionGroupQuestion)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionGroupQuestion  $questionGroupQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionGroupQuestion $questionGroupQuestion)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionGroupQuestion  $questionGroupQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionGroupQuestion $questionGroupQuestion)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionGroupQuestion  $questionGroupQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionGroup $questiongroup, Question $question)
    {
        return DB::table('question_group_questions')
                   ->where('question_group_id', '=', $questiongroup['id'])
                   ->where('question_id', '=', $question['id'])
                   ->delete();
    }
}
