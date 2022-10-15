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
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('quiz_id');$table->unsignedBigInteger('subject_id');
            $table->string('answer_name');

            $table->timestamps();

            $table->foreign('institute_id')
                ->references('id')
                ->on(\App\Models\institute\Auth\Institute::getTableName())
                ->onDelete('cascade');

            $table->foreign('student_id')
                ->references('id')
                ->on(\App\Models\institute\student\StudentInformation::getTableName())
                ->onDelete('cascade');
            $table->foreign('quiz_id')
                ->references('id')
                ->on(\App\Models\institute\quiz\Quiz::getTableName())
                ->onDelete('cascade');

            $table->foreign('subject_id')
                ->references('id')
                ->on(\App\Models\institute\quiz\Subject::getTableName())
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
        Schema::dropIfExists('quiz_answers');
    }
};
