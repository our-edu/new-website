<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchEducationalSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_educational_systems', function (Blueprint $table) {

            $table->foreignUuid('branch_id')->references('uuid')
                ->on('branches')->onDelete('cascade');

            $table->foreignUuid('educational_system_id')->references('uuid')
                ->on('educational_systems')->onDelete('cascade');

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
        Schema::dropIfExists('branch_educational_systems');
    }
}
