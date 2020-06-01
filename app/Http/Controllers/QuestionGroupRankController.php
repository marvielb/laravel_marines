<?php

namespace App\Http\Controllers;

use App\QuestionGroup;
use App\QuestionGroupRank;
use App\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pager;

class QuestionGroupRankController extends Controller
{
    use Pager;

    public function tableName()
    {
        return 'question_group_ranks';
    }

    //Overriden from pager
    public function Pagination($questiongroupid)
    {
        $mod_query = $this->query()
                          ->join('ranks', 'question_group_ranks.rank_id', '=', 'ranks.id')
                          ->where('question_group_ranks.question_group_id','=', $questiongroupid)
                          ->select('ranks.*');
        return $this->Paginate($mod_query);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionGroup $questiongroup)
    {
        return view('questiongroup.rank.index', ['questiongroup' => $questiongroup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionGroup $questiongroup)
    {
        return DB::table('ranks')->whereNotExists(function ($query){
            $query->select(DB::raw(1))
                  ->from('question_group_ranks')
                  ->whereRaw('question_group_ranks.rank_id = ranks.id');
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
            'rank_id' => 'required|exists:ranks,id|unique:question_group_ranks'
        ]);
        $validatedRequest['question_group_id'] = $questiongroup['id'];
        return QuestionGroupRank::create($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionGroupRank  $questionGroupRank
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionGroupRank $questionGroupRank)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionGroupRank  $questionGroupRank
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionGroupRank $questionGroupRank)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionGroupRank  $questionGroupRank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionGroupRank $questionGroupRank)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionGroupRank  $questionGroupRank
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionGroup $questiongroup, Rank $rank)
    {
        return DB::table('question_group_ranks')
                   ->where('question_group_id', '=', $questiongroup['id'])
                   ->where('rank_id', '=', $rank['id'])
                   ->delete();
    }
}
