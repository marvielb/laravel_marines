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
	    foreach ($this->questions as $classification => $category) {
	            $classification_id = factory(QuestionClassification::class)->create(['description' => $classification])->id;
		    foreach ($category as $questionData) {
			$question = factory(Question::class)->create([
			    'body' => $questionData['body'],
			    'classification_id' => $classification_id,
			]);
			$choices = array_map(function($choiceData) use ($question) {
			    return factory(Choice::class)->make([
				'body' => $choiceData["body"],
				'question_id' => null,
			    ])->toArray();
			}, $questionData['choices']);
			$savedChoices = $question->choices()->createMany($choices);
			$question->correct_choice_id = $savedChoices[$questionData['correct_choice_index']]->id;
			$question->save();
		    }
	}
    }

    // Define the classifications and their associated questions
protected $questions = [
    'Math' => [
        [
            'body' => 'What is the sum of 4 and 8?',
            'choices' => [
                ['body' => '8'],
                ['body' => '12'],
                ['body' => '16'],
                ['body' => '20'],
            ],
            'correct_choice_index' => 1,
        ],
        [
            'body' => 'What is 7 multiplied by 3?',
            'choices' => [
                ['body' => '9'],
                ['body' => '18'],
                ['body' => '21'],
                ['body' => '24'],
            ],
            'correct_choice_index' => 2,
        ],
        [
            'body' => 'What is the result of 14 divided by 2?',
            'choices' => [
                ['body' => '3'],
                ['body' => '7'],
                ['body' => '5'],
                ['body' => '9'],
            ],
            'correct_choice_index' => 2,
        ],
        [
            'body' => 'What is 5 subtracted from 12?',
            'choices' => [
                ['body' => '2'],
                ['body' => '5'],
                ['body' => '7'],
                ['body' => '10'],
            ],
            'correct_choice_index' => 3,
        ],
        [
            'body' => 'What is the result of 6 squared?',
            'choices' => [
                ['body' => '12'],
                ['body' => '36'],
                ['body' => '18'],
                ['body' => '24'],
            ],
            'correct_choice_index' => 1,
        ],
    ],
    'Science' => [
        [
            'body' => 'What is the process by which plants make their own food?',
            'choices' => [
                ['body' => 'Respiration'],
                ['body' => 'Photosynthesis'],
                ['body' => 'Digestion'],
                ['body' => 'Circulation'],
            ],
            'correct_choice_index' => 1,
        ],
        [
            'body' => 'What type of energy is stored in an object due to its position or configuration?',
            'choices' => [
                ['body' => 'Kinetic energy'],
                ['body' => 'Potential energy'],
                ['body' => 'Heat energy'],
                ['body' => 'Electrical energy'],
            ],
            'correct_choice_index' => 1,
        ],
        [
            'body' => 'Which of the following is a conductor of electricity?',
            'choices' => [
                ['body' => 'Glass'],
                ['body' => 'Rubber'],
                ['body' => 'Copper'],
                ['body' => 'Plastic'],
            ],
            'correct_choice_index' => 2,
        ],
        [
            'body' => 'Which planet is closest to the sun?',
            'choices' => [
                ['body' => 'Venus'],
                ['body' => 'Mars'],
                ['body' => 'Mercury'],
                ['body' => 'Saturn'],
            ],
            'correct_choice_index' => 2,
        ],
        [
            'body' => 'What type of force is required to change the direction of motion of an object?',
            'choices' => [
                ['body' => 'Friction'],
                ['body' => 'Gravity'],
                ['body' => 'Magnetism'],
                ['body' => 'Centripetal force'],
            ],
            'correct_choice_index' => 3,
        ],
    ],
    'Philippine History' => [
        [
            'body' => 'Who is known as the "Father of Philippine Revolution"?',
            'choices' => [
                ['body' => 'Emilio Aguinaldo'],
                ['body' => 'Andres Bonifacio'],
                ['body' => 'Jose Rizal'],
                ['body' => 'Antonio Luna'],
            ],
            'correct_choice_index' => 1,
        ],
        [
            'body' => 'What year did the Philippines gain independence from Spain?',
            'choices' => [
                ['body' => '1896'],
                ['body' => '1898'],
                ['body' => '1901'],
                ['body' => '1910'],
            ],
            'correct_choice_index' => 1,
        ],
        [
            'body' => 'Who is the first female president of the Philippines?',
            'choices' => [
                ['body' => 'Gloria Macapagal-Arroyo'],
                ['body' => 'Corazon Aquino'],
                ['body' => 'Imelda Marcos'],
                ['body' => 'Miriam Defensor-Santiago'],
            ],
            'correct_choice_index' => 1,
        ],
        [
            'body' => 'What is the famous battle where Lapu-Lapu defeated Magellan?',
            'choices' => [
                ['body' => 'Battle of Mactan'],
                ['body' => 'Battle of Manila Bay'],
                ['body' => 'Battle of Tirad Pass'],
                ['body' => 'Battle of Bataan'],
            ],
            'correct_choice_index' => 0,
        ],
        [
            'body' => 'What is the name of the Philippine national hero?',
            'choices' => [
                ['body' => 'Jose Rizal'],
                ['body' => 'Andres Bonifacio'],
                ['body' => 'Apolinario Mabini'],
                ['body' => 'Graciano Lopez Jaena'],
            ],
            'correct_choice_index' => 0,
        ],
    ],
    'Good Conduct' => [
        [
            'body' => 'What is the right thing to do when someone is crying?',
            'choices' => [
                ['body' => 'Laugh at them'],
                ['body' => 'Ignore them'],
                ['body' => 'Ask them what is wrong'],
                ['body' => 'Shout at them to stop'],
            ],
            'correct_choice_index' => 2,
        ],
        [
            'body' => 'What should you do if someone asks for your help?',
            'choices' => [
                ['body' => 'Say "no" and walk away'],
                ['body' => 'Ignore them'],
                ['body' => 'Help them if you can'],
                ['body' => 'Laugh at them'],
            ],
            'correct_choice_index' => 2,
        ],
        [
            'body' => 'What should you do if you accidentally break something?',
            'choices' => [
                ['body' => 'Hide it and pretend nothing happened'],
                ['body' => 'Blame someone else'],
                ['body' => 'Tell the truth and apologize'],
                ['body' => 'Laugh and run away'],
            ],
            'correct_choice_index' => 2,
        ],
        [
            'body' => 'What is the proper way to greet someone?',
            'choices' => [
                ['body' => 'Say "hi" and walk away'],
                ['body' => 'Ignore them'],
                ['body' => 'Smile and say "hello" or "good morning/afternoon/evening"'],
                ['body' => 'Shout at them to get out of your way'],
            ],
            'correct_choice_index' => 2,
        ],
        [
            'body' => 'What should you do if you see someone being bullied?',
            'choices' => [
                ['body' => 'Join in and help bully the person'],
                ['body' => 'Do nothing and pretend you didn\'t see anything'],
                ['body' => 'Tell a teacher or adult'],
                ['body' => 'Laugh and walk away'],
            ],
            'correct_choice_index' => 2,
        ],
    ],
];
}
