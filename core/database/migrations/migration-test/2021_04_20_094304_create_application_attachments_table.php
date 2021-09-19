<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_attachments', function (Blueprint $table) {
            $table->foreignUuid('application_uuid')->references('uuid')
                ->on('applications');
            $table->foreignUuid('uploaded_media_uuid')->references('uuid')
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
        Schema::dropIfExists('application_attachments');
    }
}
