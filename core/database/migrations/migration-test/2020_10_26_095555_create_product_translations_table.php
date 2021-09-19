<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->string('name')->nullable();
            $table->string('description')->nullable();

            $table->string('locale')->index();

            $table->unique(['product_uuid','locale'] ,'product_trans_with_locale');

            $table->foreignUuid('product_uuid')->references('uuid')
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
        Schema::dropIfExists('product_translations');
    }
}
