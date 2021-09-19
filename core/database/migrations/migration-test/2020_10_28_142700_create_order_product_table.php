<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->integer('product_quantity');
            $table->string('product_type');
            $table->float('product_price', 8, 2)->default(0);

            $table->foreignUuid('product_id')->references('uuid')
                ->on('products')->onDelete('cascade');

            $table->foreignUuid('order_id')->references('uuid')
                ->on('orders')->onDelete('cascade');


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
        Schema::dropIfExists('order_product');
    }
}
