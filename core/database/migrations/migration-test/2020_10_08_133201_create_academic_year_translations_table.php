<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicYearTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_year_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->string('name')->nullable();

            $table->string('locale')->index();

            $table->unique(['academic_year_uuid','locale'] ,'academic_year_id_trans_with_locale');

            $table->foreignUuid('academic_year_uuid')->references('uuid')
                ->on('academic_years')->onDelete('cascade');
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
        Schema::dropIfExists('academic_year_translations');
    }
}
