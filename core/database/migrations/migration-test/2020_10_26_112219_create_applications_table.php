<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('parent_id')->references('uuid')
                ->on('parent_users');
            $table->foreignUuid('academic_year_id')->references('uuid')
                ->on('academic_years');

            $table->foreignUuid('grade_id')->references('uuid')
                ->on('grades');

            $table->foreignUuid('educational_system_id')->references('uuid')
                ->on('educational_systems');

            $table->foreignUuid('semester_id')->references('uuid')
                ->on('semesters');
            $table->foreignUuid('branch_id')->references('uuid')
                ->on('branches');
            $table->string('first_name');
            $table->foreignUuid('image_uuid')->references('uuid')
                ->on('uploaded_media');
            $table->string('last_name');
            $table->string('national_id');
            $table->date('birthdate');
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('applications');
    }
}
