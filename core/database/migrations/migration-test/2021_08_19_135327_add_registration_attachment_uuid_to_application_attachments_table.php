<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistrationAttachmentUuidToApplicationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_attachments', function (Blueprint $table) {
            $table->foreignUuid('registration_attachment_uuid')->nullable()->references('uuid')
                ->on('registration_attachments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_attachments', function (Blueprint $table) {
            $table->dropForeign(['registration_attachment_uuid']);
        });
    }
}
