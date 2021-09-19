<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class  CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->float('pocket_money', 8, 2)->nullable();

            $table->foreignUuid('academic_year_id')->nullable()->references('uuid')
                ->on('academic_years')->onDelete('cascade');

            $table->foreignUuid('grade_class_id')->nullable()->references('uuid')
                ->on('grades')->onDelete('cascade');

            $table->foreignUuid('educational_system_id')->nullable()->references('uuid')
                ->on('educational_systems')->onDelete('cascade');

            $table->foreignUuid('semester_id')->nullable()->references('uuid')
                ->on('semesters')->onDelete('cascade');

            $table->foreignUuid('school_id')->nullable()->references('uuid')
                ->on('schools')->onDelete('cascade');

            $table->foreignUuid('user_id')->nullable()->references('uuid')
                ->on('users')->onDelete('cascade');
            $table->date('birth_date');

            $table->string('attachments')->nullable();
            $table->string('notes')->nullable();

            $table->foreignUuid('class_id')->nullable()->references('uuid')
                ->on('classrooms')->onDelete('cascade');

            $table->foreignUuid('branch_id')->nullable()->references('uuid')
                ->on('branches')->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
}
