<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MStaack\LaravelPostgis\Schema\Blueprint;

class CreateBusBusRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_bus_route', function (Blueprint $table) {
            $table->point('start_point');
            $table->time('start_time');
            $table->point('end_point');
            $table->time('end_time');
            $table->string('type');

            $table->foreignUuid('bus_uuid')->references('uuid')
                ->on('buses')->onDelete('cascade');

            $table->foreignUuid('bus_route_uuid')->references('uuid')
                ->on('bus_routes')->onDelete('cascade');

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
        Schema::dropIfExists('bus_bus_route');
    }
}
