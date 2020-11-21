<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionGroupRank extends Model
{
    protected $fillable = ['question_group_id', 'rank_id'];

    public function question_group()
    {
        return $this->belongsTo('App\QuestionGroup', 'question_group_id');
    }

    public function rank()
    {
        return $this->belongsTo('App\Rank', 'rank_id');
    }
}
