<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class QuestionGroup extends Model
{
    use LogsActivity;

    protected $fillable = ['description'];

    protected static $logAttributes = ['description'];
    protected static $logOnlyDirty = true;
}
