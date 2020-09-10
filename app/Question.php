<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['body', 'correct_choice_id'];

    protected $hidden = ['correct_choice_id'];

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    public function correctChoice()
    {
        return $this->belongsTo('App\Choice', 'correct_choice_id');
    }
}
