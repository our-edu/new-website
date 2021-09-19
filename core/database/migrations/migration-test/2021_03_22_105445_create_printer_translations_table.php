<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->string('name')->nullable();

            $table->string('locale')->index();

            $table->unique(['printer_uuid','locale'] ,'printer_uuid_trans_with_locale');

            $table->foreignUuid('printer_uuid')->references('uuid')
                ->on('printers')->onDelete('cascade');
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
        Schema::dropIfExists('printer_translations');
    }
}
