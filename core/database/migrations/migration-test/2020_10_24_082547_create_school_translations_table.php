<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unique(['school_uuid','locale'] ,'school_trans_with_locale');
            $table->foreignUuid('school_uuid')->references('uuid')
                ->on('schools')->onDelete('cascade');
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
        Schema::dropIfExists('school_translations');
    }
}
