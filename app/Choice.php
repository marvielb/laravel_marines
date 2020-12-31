<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Choice extends Model
{
    use LogsActivity;

    protected $fillable = ['body', 'question_id'];

    protected static $logAttributes = ['body', 'question_id'];
    protected static $logOnlyDirty = true;
}
