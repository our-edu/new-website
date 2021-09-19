<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_appointments', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->date('date');
            $table->smallInteger('day');
            $table->time('from');
            $table->time('to');
            $table->integer('time_frame'); // in minutes
            $table->foreignUuid('school_employee_uuid')->references('uuid')
                ->on('school_employees');
            $table->foreignUuid('parent_id')->nullable()->references('uuid')
                ->on('parent_users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interview_appointments');
    }
}
