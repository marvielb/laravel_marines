<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exam;
use App\User;
use Faker\Generator as Faker;

$factory->define(Exam::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'code' => $faker->unique()->word(),
        'started_at' => now(),
        'finished_at' => now(),
    ];
});
