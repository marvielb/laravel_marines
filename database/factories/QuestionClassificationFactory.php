<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\QuestionClassification;
use Faker\Generator as Faker;

$factory->define(QuestionClassification::class, function (Faker $faker) {
    return [
        'description' => $faker->word()
    ];
});
