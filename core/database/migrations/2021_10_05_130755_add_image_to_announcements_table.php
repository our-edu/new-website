<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->foreignUuid('web_image')->references('uuid')
                ->on('uploaded_media');
            $table->foreignUuid('mobile_image')->references('uuid')
                ->on('uploaded_media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropForeign(['web_image']);
            $table->dropColumn('web_image');
            $table->dropForeign(['mobile_image']);
            $table->dropColumn('mobile_image');
        });
    }
}
