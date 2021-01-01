<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exam;
use App\ExamQuestion;
use App\Question;
use Faker\Generator as Faker;

$factory->define(ExamQuestion::class, function (Faker $faker) {
    return [
        'exam_id' => factory(Exam::class),
        'question_id' => factory(Question::class),
        'correct_answer_id' => factory(Choice::class),
        'answer_id' => factory(Choice::class),
    ];
});
