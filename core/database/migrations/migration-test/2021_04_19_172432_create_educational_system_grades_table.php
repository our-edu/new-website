<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalSystemGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_system_grades', function (Blueprint $table) {
            $table->foreignUuid('educational_system_uuid')->references('uuid')
                ->on('educational_systems');
            $table->foreignUuid('grade_uuid')->references('uuid')
                ->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educatuional_system_grades');
    }
}
