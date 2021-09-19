<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationAttachmentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_attachment_translations', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->foreignUuid('registration_attachment_uuid')->references('uuid')
                ->on('registration_attachments');
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['registration_attachment_uuid','locale'] ,'registration_attachment_uuid_trans_with_locale');
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
        Schema::dropIfExists('registration_attachment_translations');
    }
}
