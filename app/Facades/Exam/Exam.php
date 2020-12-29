<?php

namespace App\Facades\Exam;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exam as ExamModel;
use App\User;
use App\QuestionGroupRank;
use App\QuestionGroupQuestion;
use App\ExamQuestion;

class Exam
{
    public function answerQuestion($exam_id, $answer_id)
    {
        $examQuestion = ExamQuestion::find($exam_id);
        $examQuestion->answer_id = $answer_id;
        $examQuestion->save();
    }

    public function finishExam($examCode)
    {
        $exam = ExamModel::where('code', $examCode)
            ->first();
        $exam->finished_at = Carbon::now();
        $exam->save();
    }

    public function startExam($examCode)
    {
        $exam = ExamModel::where('code', $examCode)->first();
        if (!$exam->started_at) {
            $exam->started_at = Carbon::now();
            $exam->save();
        }
    }
    public function generateExamFor($marine_number)
    {
        do {
            $code = $this->generateCode();
            $existingCode = ExamModel::where('code', $code)->get();
        } while ($existingCode->isEmpty() == false);
        $user = User::where('marine_number', $marine_number)->first();
        $exam = ExamModel::create([
            'user_id' => $user['id'],
            'code' => $code
        ]);
        $questionGroupId = QuestionGroupRank::where('rank_id', $user['rank_id'])->first()['question_group_id'];
        $questions = QuestionGroupQuestion::where('question_group_id', $questionGroupId)->get();
        $inserts = [];
        $now = Carbon::now('utc')->toDateTimeString();
        foreach ($questions as $question) {
            $inserts[] = [
                'exam_id' => $exam['id'],
                'question_id' => $question['question_id'],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        ExamQuestion::insert($inserts);
        return $exam;
    }

    private function generateCode()
    {
        return strtoupper(sha1(time()));
    }
}
