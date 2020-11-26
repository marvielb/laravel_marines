<?php

use App\QuestionClassification;
use Illuminate\Database\Seeder;

class QuestionClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(QuestionClassification::class, 4);
    }
}
