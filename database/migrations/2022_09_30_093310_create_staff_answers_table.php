<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('topic_id');
            $table->string('answer_name');

            $table->timestamps();

            $table->foreign('institute_id')
                ->references('id')
                ->on(\App\Models\institute\Auth\Institute::getTableName())
                ->onDelete('cascade');

            $table->foreign('staff_id')
                ->references('id')
                ->on(\App\Models\institute\staff\StaffInformation::getTableName())
                ->onDelete('cascade');
            $table->foreign('question_id')
                ->references('id')
                ->on(\App\Models\institute\questions\Question::getTableName())
                ->onDelete('cascade');

            $table->foreign('topic_id')
                ->references('id')
                ->on(\App\Models\institute\questions\Topic::getTableName())
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_answers');
    }
};
