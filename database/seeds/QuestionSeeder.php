<?php

use App\Question;
use App\Choice;
use App\QuestionClassification;
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
        $classifications = factory(QuestionClassification::class, 4)->create();
        factory(Question::class, 20)->create()->each(function ($question) use ($classifications) {
            $choices = factory(Choice::class, 4)->make(['question_id' => null])->toArray();
            $savedChoices = $question->choices()->createMany($choices);
            $question['correct_choice_id'] = $savedChoices[rand(0, 3)]['id'];
            $question['classification_id'] = $classifications[rand(0, 3)]['id'];
            $question->save();
        });
    }
}
