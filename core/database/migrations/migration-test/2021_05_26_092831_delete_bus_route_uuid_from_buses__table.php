<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteBusRouteUuidFromBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->dropForeign('buses_bus_route_uuid_foreign');
            $table->dropColumn('bus_route_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->foreignUuid('bus_route_uuid')->references('uuid')
                ->on('bus_routes')->onDelete('cascade');
        });
    }
}
