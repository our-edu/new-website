<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->integer('product_quantity');
            $table->string('product_type');
            $table->float('product_price', 8, 2)->default(0);
            $table->foreignUuid('cart_id')->references('uuid')
                ->on('carts')->onDelete('cascade');

            $table->foreignUuid('product_id')->references('uuid')
                ->on('products')->onDelete('cascade');

            $table->foreignUuid('parent_product_id')->nullable()->references('uuid')
                ->on('products')->onDelete('cascade');

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
        Schema::dropIfExists('cart_product');
    }
}
