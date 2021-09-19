<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_translations', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->foreignUuid('service_uuid')->references('uuid')
                ->on('services')->onDelete('cascade');
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['service_uuid','locale'] ,'service_uuid_trans_with_locale');
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
        Schema::dropIfExists('serviece_translations');
    }
}
