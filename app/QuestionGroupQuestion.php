<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class QuestionGroupQuestion extends Model
{
    use LogsActivity;

    protected $fillable = ['question_group_id', 'question_id'];

    protected static $logAttributes = ['question_group_id', 'question_id'];
    protected static $logOnlyDirty = true;
}
