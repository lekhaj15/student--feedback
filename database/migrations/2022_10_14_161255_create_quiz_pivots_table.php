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
        Schema::create('quiz_pivots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('quiz_id');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on(\App\Models\institute\grade\GradeCategory::getTableName())
                ->onDelete('cascade');

            $table->foreign('subcategory_id')
                ->references('id')
                ->on(\App\Models\institute\grade\GradeSubCategory::getTableName())
                ->onDelete('cascade');

            $table->foreign('institute_id')
                ->references('id')
                ->on(\App\Models\institute\Auth\Institute::getTableName())
                ->onDelete('cascade');

            $table->foreign('subject_id')
                ->references('id')
                ->on(\App\Models\institute\quiz\Subject::getTableName())
                ->onDelete('cascade');

            $table->foreign('quiz_id')
                ->references('id')
                ->on(\App\Models\institute\quiz\Quiz::getTableName())
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
        Schema::dropIfExists('quiz_pivots');
    }
};
