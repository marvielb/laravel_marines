<?php

use Illuminate\Database\Seeder;

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
        // $this->call(QuestionSeeder::class);
        // $this->call(QuestionGroupSeeder::class);
    }
}
