<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalSystemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_system_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unique(['educational_system_uuid','locale'] ,'educational_system_uuid_trans_with_locale');
            $table->foreignUuid('educational_system_uuid')->references('uuid')
                ->on('educational_systems')->onDelete('cascade');
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
        Schema::dropIfExists('educational_system_translations');
    }
}
