<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_semesters', function (Blueprint $table) {
            $table->foreignUuid('application_uuid')->nullable()->references('uuid')
                ->on('applications')->onDelete('cascade');
            $table->foreignUuid('semester_uuid')->references('uuid')
                ->on('semesters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_semesters');
    }
}
