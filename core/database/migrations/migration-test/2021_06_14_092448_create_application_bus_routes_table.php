<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationBusRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_bus_routes', function (Blueprint $table) {
            $table->foreignUuid('application_uuid')->nullable()->references('uuid')
                ->on('applications')->onDelete('cascade');
            $table->foreignUuid('bus_route_uuid')->references('uuid')
                ->on('bus_routes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_bus_routes');
    }
}
