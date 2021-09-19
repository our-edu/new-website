<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches_employees', function (Blueprint $table) {

            $table->foreignUuid('branch_id')->references('uuid')
                ->on('branches')->onDelete('cascade');

            $table->foreignUuid('employee_id')->references('uuid')
                ->on('school_employees')->onDelete('cascade');
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
        Schema::dropIfExists('branches_employees');
    }
}
