<?php

namespace App\Facades\Exam;

use App\Choice;
use Carbon\Carbon;
use App\Exam as ExamModel;
use App\User;
use App\QuestionGroupRank;
use App\QuestionGroupQuestion;
use App\ExamQuestion;
use App\Exceptions\AnswerDoesNotBelongToQuestionException;
use App\Exceptions\ExamFinishedException;
use App\Exceptions\QuestionGroupNoQuestionsException;
use App\Exceptions\RankNoQuestionGroupException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class Exam
{
    public function isExamFinished($examCode)
    {
        $exam = ExamModel::where('code', $examCode)->first();

        if ($exam == null) {
            throw new ModelNotFoundException('Exam with code ' . $examCode . ' does not exists');
        }

        return $exam->is_finished;
    }

    public function answerQuestion($examQuestionId, $answerId)
    {
        $examQuestion = ExamQuestion::find($examQuestionId);
        if ($examQuestion == null) {
            throw new ModelNotFoundException('Exam question is not found');
        }
        $answer = Choice::where('question_id', '=', $examQuestion['question_id'])
            ->where('id', '=', $answerId)->first();
        if ($answer == null) {
            throw new AnswerDoesNotBelongToQuestionException('The answer does not belong to the question');
        }
        $examQuestion->answer_id = $answerId;
        $examQuestion->save();
    }

    public function finishExam($examCode)
    {
        $exam = ExamModel::where('code', $examCode)
            ->first();

        if ($exam == null) {
            throw new ModelNotFoundException('Exam with exam code ' . $examCode . ' is not found');
        }

        if ($this->isExamFinished($examCode)) {
            throw new ExamFinishedException();
        }

        $exam->finished_at = Carbon::now();
        $exam->save();
    }

    public function startExam($examCode)
    {
        $exam = ExamModel::where('code', $examCode)->first();

        if ($exam == null) {
            throw new ModelNotFoundException('Exam with exam code ' . $examCode . ' is not found');
        }

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
        if ($user == null) {
            throw new ModelNotFoundException('Marine Number ' . $marine_number . ' does not exists');
        }
        $questionGroupRank = QuestionGroupRank::where('rank_id', $user['rank_id'])->first();
        if ($questionGroupRank == null) {
            throw new RankNoQuestionGroupException("Cannot generate exam for {$marine_number} because the user's rank ({$user->rank->description}) does not belong to a question group");
        }
        $questions = QuestionGroupQuestion::where('question_group_id', $questionGroupRank['question_group_id'])->get();
        if (count($questions) == 0) {
            throw new QuestionGroupNoQuestionsException("Cannot generate exam for {$marine_number} because the user's rank question group ({$user->rank->question_group->description}) does not have questions");
        }
        DB::beginTransaction();
        try {
            $exam = ExamModel::create([
                'user_id' => $user['id'],
                'code' => $code
            ]);
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
            DB::commit();
            return $exam;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function generateCode()
    {
        return strtoupper(sha1(time()));
    }
}
