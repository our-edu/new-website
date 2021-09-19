<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesRegistrationAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades_registration_attachments', function (Blueprint $table) {
            $table->foreignUuid('grade_uuid')->nullable()->references('uuid')
                ->on('grades')->onDelete('cascade');
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
