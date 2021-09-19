<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationAttachmentsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_attachments_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('grade_uuid')->nullable()->references('uuid')
                ->on('grades')->onDelete('cascade');
            $table->foreignUuid('registration_attachment_uuid')->nullable()->references('uuid')
                ->on('registration_attachments')->onDelete('cascade');
            $table->foreignUuid('educational_system_uuid')->nullable()->references('uuid')
                ->on('educational_systems')->onDelete('cascade');
            $table->smallInteger('nationality');
            $table->unique(['grade_uuid','registration_attachment_uuid','educational_system_uuid','nationality']);

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
        Schema::dropIfExists('registration_attachments_roles');
    }
}
