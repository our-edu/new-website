<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalitiesRegistrationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities_registration_attachments', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->smallInteger('nationality');

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
        Schema::dropIfExists('registration_attachments');
    }
}
