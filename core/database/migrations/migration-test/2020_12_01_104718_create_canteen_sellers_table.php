<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanteenSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canteen_sellers', function (Blueprint $table) {

            $table->foreignUuid('user_uuid')->references('uuid')
                ->on('users')->onDelete('cascade');

            $table->foreignUuid('canteen_uuid')->references('uuid')
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
        Schema::dropIfExists('canteen_sellers');
    }
}
