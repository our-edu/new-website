<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchAcademicYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_academic_years', function (Blueprint $table) {

            $table->foreignUuid('branch_id')->references('uuid')
                ->on('branches')->onDelete('cascade');

            $table->foreignUuid('academic_year_id')->references('uuid')
                ->on('academic_years')->onDelete('cascade');

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
        Schema::dropIfExists('branch_academic_years');
    }
}
