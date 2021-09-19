<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->string('status')->nullable();
            $table->float('total_price', 8, 2)->default(0);
            $table->foreignUuid('user_uuid')->references('uuid')
                ->on('users')->onDelete('cascade');

            $table->foreignUuid('canteen_id')->references('uuid')
                ->on('canteens')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
