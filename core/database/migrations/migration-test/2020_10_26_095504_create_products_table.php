<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('image')->nullable();
            $table->string('type');
            $table->string('trademark');
            $table->integer('quantity');
            $table->integer('min_stock');
            $table->float('price', 8, 2);
            $table->float('calories', 8, 2);

            $table->foreignUuid('category_id')->references('uuid')
                ->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
