<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class QuestionGroupRank extends Model
{
    use LogsActivity;

    protected $fillable = ['question_group_id', 'rank_id'];

    protected static $logAttributes = ['question_group_id', 'rank_id'];
    protected static $logOnlyDirty = true;

    public function question_group()
    {
        return $this->belongsTo('App\QuestionGroup', 'question_group_id');
    }

    public function rank()
    {
        return $this->belongsTo('App\Rank', 'rank_id');
    }
}
