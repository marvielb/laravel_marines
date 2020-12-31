<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Exam extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'code'
    ];

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    public function exam_questions()
    {
        return $this->hasMany('App\ExamQuestion');
    }

    public function examinee()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getIsFinishedAttribute($value)
    {
        return $this->finished_at != null;
    }
}
