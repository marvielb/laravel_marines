<?php

namespace Tests\Unit;

use App\User;
use App\Choice;
use App\ExamQuestion;
use App\Facades\Exam\Exam;
use App\Exam as ExamModel;
use App\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Exceptions\AnswerDoesNotBelongToQuestionException;
use App\Exceptions\ExamFinishedException;
use App\Exceptions\QuestionGroupNoQuestionsException;
use App\Exceptions\RankNoQuestionGroupException;
use App\QuestionGroupQuestion;
use App\QuestionGroupRank;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExamServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $examService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->examService = new Exam;
    }

    public function testIsExamFinishedReturnsTrueIfTheFinishedAtAttributeIsAlreadySet()
    {
        $exam = factory(ExamModel::class)->create([
            'finished_at' => now()
        ]);
        $this->assertEquals(true, $this->examService->isExamFinished($exam['code']));
    }

    public function testIsExamFinishedReturnsFalseIfTheFinishedAtAttributeIsNull()
    {
        $exam = factory(ExamModel::class)->create([
            'finished_at' => null
        ]);
        $this->assertEquals(false, $this->examService->isExamFinished($exam['code']));
    }

    public function testIsExamFinishedThrowsAnExceptionIfTheExamCodeIsNotFound()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->examService->isExamFinished('Some code that does not exists');
    }

    public function testGenerateExamForShouldCreateAnExamOfTheUserAndTheQuestionGroupsQuestions()
    {
        $user = factory(User::class)->create();
        $questionGroupRank = factory(QuestionGroupRank::class)->create(['rank_id' => $user['rank_id']]);
        $questions = factory(Question::class, 3)->create()->each(function ($question) use ($questionGroupRank) {
            factory(QuestionGroupQuestion::class)->create([
                'question_id' => $question['id'],
                'question_group_id' => $questionGroupRank['question_group_id'],
            ]);
        });
        $exam = $this->examService->generateExamFor($user['marine_number']);
        $examQuestions = ExamQuestion::where('exam_id', $exam['id'])->get();
        $this->assertEquals(
            array_map(function ($v) {
                return $v['id'];
            }, $questions->toArray()),
            array_map(function ($v) {
                return $v['question_id'];
            }, $examQuestions->toArray())
        );
    }

    public function testGenerateExamForShouldThrowAnExceptionIfQuestionGroupDoesNotHaveQuestions()
    {
        $this->expectException(QuestionGroupNoQuestionsException::class);
        $user = factory(User::class)->create();
        factory(QuestionGroupRank::class)->create(['rank_id' => $user['rank_id']]);
        $this->examService->generateExamFor($user['marine_number']);
    }

    public function testGenerateExamForShouldThrowAnExceptionIfRankDoesNotHaveQuestionGroup()
    {
        $this->expectException(RankNoQuestionGroupException::class);
        $user = factory(User::class)->create();
        $this->examService->generateExamFor($user['marine_number']);
    }

    public function testGenerateExamForShouldThrowAnExceptionIfMarineNumberIsNotFound()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->examService->generateExamFor('marine number that does not exists');
    }


    public function testStartExamMustFillUpStartedAtFieldByNow()
    {
        $exam = factory(ExamModel::class)->create([
            'started_at' => null,
            'finished_at' => null,
        ]);
        Carbon::setTestNow('2020-01-01 00:00:00');
        $this->examService->startExam($exam['code']);
        $retreived = ExamModel::where('code', $exam['code'])->first();
        $this->assertEquals($retreived['started_at'], '2020-01-01 00:00:00');
    }

    public function testStartExamMustThrowAnExceptionIfExamCodeIsNotFound()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->examService->startExam('exam code that does not exists');
    }

    public function testFinishExamFillsUpTheFinishedAtField()
    {
        $exam = factory(ExamModel::class)->create([
            'finished_at' => null
        ]);
        Carbon::setTestNow('2020-01-01');
        $this->examService->finishExam($exam['code']);
        $retreived = ExamModel::where('code', $exam['code'])->first();
        $this->assertEquals($retreived['finished_at'], '2020-01-01 00:00:00');
    }

    public function testFinishExamMustThrowAnExceptionIfTheExamCodeIsNotFound()
    {
        $exam = factory(ExamModel::class)->create([
            'code' => 'legit code here',
        ]);
        $this->expectException(ModelNotFoundException::class);
        $this->examService->finishExam('code here that does not exist');
    }

    public function testFinishExamMustThrowAnExceptionIfTheExamIsAlreadyFinished()
    {
        $exam = factory(ExamModel::class)->create();
        $this->expectException(ExamFinishedException::class);
        $this->examService->finishExam($exam['code']);
    }


    public function testAnswerQuestionMustFillUpTheQuestion()
    {
        $question = factory(Question::class)->create();
        $choice = factory(Choice::class)->create(
            ['question_id' => $question['id'],]
        );
        $examQuestion = factory(ExamQuestion::class)->create([
            'question_id' => $question['id'],
            'answer_id' => null
        ]);
        $this->examService->answerQuestion($examQuestion['id'], $choice['id']);
        $fetched = ExamQuestion::find($examQuestion['id'])->first();
        $this->assertEquals($choice['id'], $fetched['answer_id']);
    }

    public function testAnswerQuestionMustThrowAnExceptionIfTheChoiceDoesNotBelongToTheQuestion()
    {
        $question = factory(Question::class)->create();
        $question2 = factory(Question::class)->create();
        $choice = factory(Choice::class)->create([
            'question_id' => $question['id']
        ]);
        $examQuestion = factory(ExamQuestion::class)->create([
            'question_id' => $question2['id'],
            'answer_id' => null
        ]);
        $this->expectException(AnswerDoesNotBelongToQuestionException::class);
        $this->examService->answerQuestion($examQuestion['id'], $choice['id']);
    }
}
