<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('track_scripts')->nullable();
            $table->string("facebook_link")->nullable();
            $table->string("twitter_link")->nullable();
            $table->string("twitter_feed")->nullable();
            $table->string("linked_in_link")->nullable();
            $table->string("instagram_link")->nullable();
            $table->string("snap_chat_link")->nullable();
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
        Schema::dropIfExists('settings');
    }
}
