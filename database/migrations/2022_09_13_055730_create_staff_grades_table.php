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
                $table->unsignedBigInteger('institute_id');

                $table->unsignedBigInteger('s_id');
                $table->unsignedBigInteger('category_id');
                $table->unsignedBigInteger('subcategory_id');
                $table->timestamps();

                $table->foreign('category_id',)
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

                $table->foreign('institute_id')
                    ->references('id')
                    ->on(\App\Models\institute\Auth\Institute::getTableName())
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


