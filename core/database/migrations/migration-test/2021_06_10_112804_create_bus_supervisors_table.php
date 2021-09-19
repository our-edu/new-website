<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_supervisors', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->foreignUuid('user_id')->references('uuid')
                ->on('users')->onDelete('cascade');

            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches')->onDelete('cascade');

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
        Schema::dropIfExists('bus_supervisors');
    }
}
