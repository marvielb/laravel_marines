<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $fillable = ['description'];

    public function question_group()
    {
        return $this->hasOneThrough('App\QuestionGroup', 'App\QuestionGroupRank', 'question_group_id', 'id', 'id', 'rank_id');
    }
}
