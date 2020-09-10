<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $fillable = [
        'exam_id',
        'question_id',
        'answer_id'
    ];

    public function question() {
        return $this->belongsTo('App\Question');
    }

}
