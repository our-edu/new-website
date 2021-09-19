<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchUuidForBusRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bus_routes', function (Blueprint $table) {
            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bus_routes', function (Blueprint $table) {

            $table->dropColumn('branch_uuid');
        });
    }
}
