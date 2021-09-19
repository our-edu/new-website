<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGeneralConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_general_config', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->foreignUuid('student_uuid')->references('uuid')
                ->on('students')->onDelete('cascade');

            $table->float('money_amount_per_day', 8, 2)->default(0)->nullable();
            $table->float('calories_amount_per_day', 8, 2)->default(0);

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
        Schema::dropIfExists('student_general_config');
    }
}
