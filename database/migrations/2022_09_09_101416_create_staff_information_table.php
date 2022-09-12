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
        Schema::create('staff_information', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->string('staff_name');
            $table->string('staff_email');
            $table->integer('staff_phone');
            $table->integer('staff_dob');
            $table->string('staff_password');
            $table->timestamps();


            $table->foreign('category_id')
                ->references('id')
                ->on(\App\Models\institute\grade\GradeCategory::getTableName())
                ->onDelete('cascade');

            $table->foreign('subcategory_id')
                ->references('id')
                ->on(\App\Models\institute\grade\GradeSubCategory::getTableName())
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
        Schema::dropIfExists('staff_information');
    }
};
