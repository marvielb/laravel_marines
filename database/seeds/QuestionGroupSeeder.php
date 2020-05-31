<?php

use App\QuestionGroup;
use Illuminate\Database\Seeder;

class QuestionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(QuestionGroup::class,3)->create();
    }
}
