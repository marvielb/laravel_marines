<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Question extends Model
{
    use LogsActivity;

    protected $fillable = ['body', 'correct_choice_id', 'classification_id'];

    protected $hidden = ['correct_choice_id'];

    protected static $logAttributes = ['body', 'correct_choice_id', 'classification_id'];

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    public function correctChoice()
    {
        return $this->belongsTo('App\Choice', 'correct_choice_id');
    }
}
