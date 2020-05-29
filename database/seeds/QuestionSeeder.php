<?php

use App\Question;
use App\Choice;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Question::class,20)->create()->each(function ($question) {
            $choices = factory(Choice::class,4)->make()->toArray();
            $savedChoices = $question->choices()->createMany($choices);
            $question['correct_choice_id'] = $savedChoices[rand(0,3)]['id'];
            $question->save();
        });
    }
}
