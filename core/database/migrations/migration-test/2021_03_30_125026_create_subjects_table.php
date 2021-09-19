<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->string('type');

            $table->foreignUuid('educational_system_uuid')->nullable()->references('uuid')
                ->on('educational_systems');

            $table->foreignUuid('semester_uuid')->nullable()->references('uuid')
                ->on('semesters');

            $table->foreignUuid('academic_year_uuid')->nullable()->references('uuid')
                ->on('academic_years');
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
        Schema::dropIfExists('subjects');
    }
}
