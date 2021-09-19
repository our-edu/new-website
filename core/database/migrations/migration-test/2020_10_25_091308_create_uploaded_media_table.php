<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadedMediaTable extends Migration
{
    /**
     * Run the migrations.
     *cd
     * @return void
     */
    public function up()
    {
        Schema::create('uploaded_media', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('source_filename')->nullable();
            $table->string('filename')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('size')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('url')->nullable();
            $table->string('extension')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('uploaded_media');
    }
}
