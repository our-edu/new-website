<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_semesters', function (Blueprint $table) {

            $table->foreignUuid('branch_id')->references('uuid')
                ->on('branches')->onDelete('cascade');

            $table->foreignUuid('semester_id')->references('uuid')
                ->on('semesters')->onDelete('cascade');
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
        Schema::dropIfExists('branch_semesters');
    }
}
