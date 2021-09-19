<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MStaack\LaravelPostgis\Schema\Blueprint;

class CreateRouteTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_route_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name');
            $table->string('locale')->index();

            $table->foreignUuid('bus_route_uuid')->references('uuid')
                ->on('bus_routes')->onDelete('cascade');

           $table->unique(['bus_route_uuid','locale'] ,'bus_route_uuid_trans_with_locale');

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
        Schema::dropIfExists('route_translations');
    }
}
