<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionGroupRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_group_ranks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_group_id');
            $table->unsignedBigInteger('rank_id');
            $table->timestamps();

            $table->foreign('question_group_id')->references('id')->on('question_groups');
            $table->foreign('rank_id')->references('id')->on('ranks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_group_ranks');
    }
}
