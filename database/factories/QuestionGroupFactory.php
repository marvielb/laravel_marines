<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\QuestionGroup;
use Faker\Generator as Faker;

$factory->define(QuestionGroup::class, function (Faker $faker) {
    return [
        'description' => $faker->word()
    ];
});
