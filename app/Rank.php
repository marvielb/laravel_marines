<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Rank extends Model
{
    use LogsActivity;

    protected $fillable = ['description'];

    protected static $logAttributes = ['description'];
    protected static $logOnlyDirty = true;

    public function question_group()
    {
        return $this->hasOneThrough('App\QuestionGroup', 'App\QuestionGroupRank', 'question_group_id', 'id', 'id', 'rank_id');
    }
}
