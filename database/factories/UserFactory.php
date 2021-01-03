<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rank;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'marine_number' => $faker->regexify('[0-9]{20}'),
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName(),
        'middle_name' => $faker->lastName,
        'rank_id' => factory(Rank::class),
        'last_promotion' => $faker->date(),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make(12345), // password
        'remember_token' => Str::random(10),
        'image' => 'test'
    ];
});
