<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MStaack\LaravelPostgis\Schema\Blueprint;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('plate_number');
            $table->string('brand');
            $table->string('color');
            $table->string('capacity');

            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches');

            $table->foreignUuid('driver_uuid')->nullable()->references('uuid')
                ->on('drivers')->onDelete('cascade');

            $table->foreignUuid('supervisor_uuid')->nullable()->references('uuid')
                ->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('buses');
    }
}
