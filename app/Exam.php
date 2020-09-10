<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exam extends Model
{
    protected $fillable = [
        'user_id',
        'code'
    ];


    public static function generate($marine_number)
    {
        do {
            $code = Exam::generateCode();
            $existingCode = Exam::where('code', $code)->get();
        } while ($existingCode->isEmpty() == false);
        $user = User::where('marine_number', $marine_number)->first();
        $exam = Exam::create([
            'user_id' => $user['id'],
            'code' => $code
        ]);
        $questionGroupId = QuestionGroupRank::where('rank_id', $user['rank_id'])->first()['question_group_id'];
        $questions = QuestionGroupQuestion::where('question_group_id', $questionGroupId)->get();
        $inserts = [];
        $now = Carbon::now('utc')->toDateTimeString();
        foreach($questions as $question) {
            $inserts[] = [
                'exam_id' => $exam['id'],
                'question_id' => $question['question_id'],
                'created_at'=> $now,
                'updated_at'=> $now
            ];
        }
        ExamQuestion::insert($inserts);
        return $exam;
    }

    private static function generateCode()
    {
        return strtoupper(sha1(time()));
    }

    public function exam_questions()
    {
        return $this->hasMany('App\ExamQuestion');
    }
}
