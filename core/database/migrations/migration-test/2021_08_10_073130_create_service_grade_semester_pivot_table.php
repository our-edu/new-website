<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceGradeSemesterPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_grade_semesters', function (Blueprint $table) {
            $table->foreignUuid('service_grade_uuid')
                ->references('uuid')
                ->on('services_grades');

            $table->foreignUuid('semester_uuid')
                ->references('uuid')
                ->on('semesters');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_grade_semesters');
    }
}
