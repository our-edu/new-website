<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches_managers', function (Blueprint $table) {
            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches')->onDelete('CASCADE');

            $table->foreignUuid('manager_uuid')->references('uuid')
                ->on('users')->onDelete('CASCADE');

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
        Schema::dropIfExists('branches_managers');
    }
}
