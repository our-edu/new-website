<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_order_items', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('service_order_uuid')->references('uuid')
                ->on('service_orders');
            $table->foreignUuid('service_uuid')->references('uuid')
                ->on('services');
            $table->float('price');
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
        Schema::dropIfExists('application_order_items');
    }
}
