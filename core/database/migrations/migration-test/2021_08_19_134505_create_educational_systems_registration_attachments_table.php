<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalSystemsRegistrationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_systems_registration_attachments', function (Blueprint $table) {
            $table->foreignUuid('educational_system_uuid')->nullable()->references('uuid')
                ->on('educational_systems')->onDelete('cascade');
            $table->foreignUuid('registration_attachment_uuid')->nullable()->references('uuid')
                ->on('registration_attachments')->onDelete('cascade');

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
        Schema::dropIfExists('grades_registration_attachments');
    }
}
