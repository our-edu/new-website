<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceGradeUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_grades', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('service_uuid')->references('uuid')
                ->on('services');
            $table->foreignUuid('grade_uuid')->references('uuid')
                ->on('grades');
            $table->float('cost')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     */
    public function down()
    {
        Schema::dropIfExists('services_grades');
    }
}
