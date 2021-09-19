<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_working_hours', function (Blueprint $table) {
            $table->uuid('uuid');
	        $table->primary('uuid');
            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches');
            $table->string('mobile')->nullable();
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
        Schema::dropIfExists('branch_working_hours');
    }
}
