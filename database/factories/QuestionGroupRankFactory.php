<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\QuestionGroup;
use App\QuestionGroupRank;
use App\Rank;
use Faker\Generator as Faker;

$factory->define(QuestionGroupRank::class, function (Faker $faker) {
    return [
        'question_group_id' => factory(QuestionGroup::class),
        'rank_id' => factory(Rank::class)
    ];
});
