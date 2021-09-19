<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MStaack\LaravelPostgis\Schema\Blueprint;

class CreateBusTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('description');
            $table->string('locale')->index();

            $table->foreignUuid('bus_uuid')->references('uuid')
                ->on('buses')->onDelete('cascade');

           $table->unique(['bus_uuid','locale'] ,'bus_uuid_trans_with_locale');

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
        Schema::dropIfExists('bus_translations');
    }
}
