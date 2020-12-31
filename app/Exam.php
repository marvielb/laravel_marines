<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'user_id',
        'code'
    ];

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
