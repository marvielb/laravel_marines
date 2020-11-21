<?php

use App\QuestionGroup;
use App\QuestionGroupQuestion;
use App\QuestionGroupRank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ApplicantSeeder::class);
        $this->call(UserTableSeeder::class);

        // $this->call(RankSeeder::class);
        $this->call(QuestionSeeder::class);
        // $this->call(QuestionGroupSeeder::class);
        $questionGroup = factory(QuestionGroup::class)->create();

        $user = DB::table('users')
            ->where('marine_number', '123')
            ->first(['rank_id']);
        $questions = DB::table('questions')
            ->get();


        factory(QuestionGroupRank::class)->create([
            'question_group_id' => $questionGroup['id'],
            'rank_id' => $user->rank_id
        ]);
        foreach ($questions as $question) {
            factory(QuestionGroupQuestion::class)->create([
                'question_group_id' => $questionGroup['id'],
                'question_id' => $question->id
            ]);
        }
    }
}
