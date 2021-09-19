<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_accounts', function (Blueprint $table) {
            $table->uuid('uuid');
	        $table->primary('uuid');
            $table->foreignUuid('school_uuid')->references('uuid')
                ->on('schools');
            $table->foreignUuid('image_uuid')->references('uuid')
                ->on('uploaded_media');
            $table->string('number')->nullable();
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
        Schema::dropIfExists('school_accounts');
    }
}
