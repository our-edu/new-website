<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatorUuidToCommunicationsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('communications_log', function (Blueprint $table) {
            $table->foreignUuid('creator_uuid')->nullable()->references('uuid')
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
        Schema::table('communications_log', function (Blueprint $table) {
            $table->dropForeign(['creator_uuid']);
            $table->dropColumn('creator_uuid');
        });
    }
}
