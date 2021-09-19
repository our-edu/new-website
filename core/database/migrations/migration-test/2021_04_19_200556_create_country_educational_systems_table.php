<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryEducationalSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries_educational_systems', function (Blueprint $table) {
            $table->foreignUuid('educational_system_uuid')->references('uuid')
                ->on('educational_systems');
            $table->foreignUuid('country_uuid')->references('uuid')
                ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries_educational_system');
    }
}
