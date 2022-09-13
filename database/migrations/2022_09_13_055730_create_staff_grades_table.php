<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('staff_grades')) {
            Schema::create('staff_grades', function (Blueprint $table) {
                $table->id();
                $table->increments('s_id');
                $table->integer('category_id');
                $table->integer('subcategory_id');
                $table->timestamps();

                $table->foreign('category_id')
                    ->references('id')
                    ->on(\App\Models\institute\grade\GradeCategory::getTableName())
                    ->onDelete('cascade');

                $table->foreign('subcategory_id')
                    ->references('id')
                    ->on(\App\Models\institute\grade\GradeSubCategory::getTableName())
                    ->onDelete('cascade');

                $table->foreign('s_id')
                    ->references('id')
                    ->on(\App\Models\institute\staff\StaffInformation::getTableName())
                    ->onDelete('cascade');

            });
        }
    }


        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public
        function down()
        {
            Schema::dropIfExists('staff_grades');
        }
    };


