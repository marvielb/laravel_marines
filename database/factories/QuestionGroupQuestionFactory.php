<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\QuestionGroupQuestion;
use Faker\Generator as Faker;

$factory->define(QuestionGroupQuestion::class, function (Faker $faker) {
    return [
        'question_group_id' => factory(QuestionGroup::class),
        'question_id' => factory(Question::class)
    ];
});
