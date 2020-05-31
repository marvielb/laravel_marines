<?php

namespace App\Http\Controllers;

use App\QuestionGroup;
use Illuminate\Http\Request;
use Pager;

class QuestionGroupController extends Controller
{
    use Pager;

    public function tableName()
    {
        return 'question_groups';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questiongroup.index');
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
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'description' => 'required|unique:question_groups'
        ]);
        return QuestionGroup::create($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionGroup  $questionGroup
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionGroup $questionGroup)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionGroup  $questionGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionGroup $questiongroup)
    {
        return $questiongroup;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionGroup  $questionGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionGroup $questiongroup)
    {
        $validatedRequest = $request->validate([
            'description' => 'required|unique:question_groups'
        ]);
        return $questiongroup->update($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionGroup  $questionGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionGroup $questiongroup)
    {
        $questiongroup->delete();
    }
}
