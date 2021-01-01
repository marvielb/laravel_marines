<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ExamQuestion extends Model
{
    use LogsActivity;

    protected $fillable = [
        'exam_id',
        'question_id',
        'correct_answer_id',
        'answer_id'
    ];

    protected $hidden = ['correct_answer_id'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    protected static $logAttributes = ['exam_id', 'question_id', 'answer_id', 'correct_answer_id'];
    protected static $logOnlyDirty = true;
    protected static $recordEvents = ['deleted', 'updated'];
}
