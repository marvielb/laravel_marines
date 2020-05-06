<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Applicant;
use Faker\Generator as Faker;

$factory->define(Applicant::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName(),
        'middleName' => $faker->lastName(),
        'lastName' => $faker->lastName(),
        'mobileNumber' => $faker->phoneNumber()
    ];
});
