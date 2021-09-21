<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('events_info');

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['branch_uuid']);
            $table->dropColumn('branch_uuid');
            $table->boolean('full_day');
            $table->boolean('all_branches');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->foreignUuid('creator_uuid')->references('uuid')
                ->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches');
            $table->dropColumn('full_day');
            $table->dropColumn('all_branches');
            $table->dropColumn('start');
            $table->dropColumn('end');
            $table->dropForeign(['creator_uuid']);
            $table->dropColumn('creator_uuid');
        });

        Schema::create('events_info', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('event_uuid')->references('uuid')
                ->on('events');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->softDeletes();
            $table->timestamps();
        });
    }
}
