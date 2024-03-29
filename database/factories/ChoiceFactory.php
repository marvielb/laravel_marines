<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Choice;
use App\Question;
use Faker\Generator as Faker;

$factory->define(Choice::class, function (Faker $faker) {
    return [
        'question_id' => factory(Question::class),
        'body' => $faker->sentence()
    ];
});
