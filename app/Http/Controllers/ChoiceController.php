<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Question;
use Illuminate\Http\Request;
use Pager;

class ChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use Pager;

    //Overriden from Pager
    public function tableName()
    {
        return 'choices';
    }

    //Overriden from pager
    public function Pagination($questionId)
    {
        $mod_query = $this->query()
                          ->join('questions', 'choices.question_id', '=', 'questions.id')
                          ->where('questions.id','=', $questionId)
                          ->select('choices.*');
        return $this->Paginate($mod_query);
    }

    public function index(Question $question)
    {
        return view('choice.index', ['question' => $question]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $questionId)
    {
        $validatedRequest = $request->validate([
            'body' => 'required'
        ]);
        $validatedRequest['question_id'] = $questionId;
        return Choice::create($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function show(Choice $choice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function edit($questionId,Choice $choice)
    {
        return $choice;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$questionId, Choice $choice)
    {
        $validatedRequest = $request->validate([
            'body' => 'required'
        ]);
        return $choice->update($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function destroy($questionId, Choice $choice)
    {
        return $choice['question_id'] == $questionId ? $choice->delete() : abort(404);
    }

    public function setAsCorrectAnswer(Question $question, Choice $choice) {
        $question->correct_choice_id = $choice['id'];
        return ($question['id'] == $choice['question_id']) ? $question->save() : abort(404);
    }

}
