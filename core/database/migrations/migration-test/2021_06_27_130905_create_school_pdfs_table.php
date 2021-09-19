<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolPdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_pdfs', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
            $table->foreignUuid('school_uuid')->references('uuid')
                ->on('schools');
            $table->string('slug');
            $table->foreignUuid('file_uuid')->references('uuid')
                ->on('uploaded_media');

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
        Schema::dropIfExists('school_pdfs');
    }
}
