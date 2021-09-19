<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->string('name')->nullable();

            $table->string('locale')->index();

            $table->unique(['grade_uuid','locale'] ,'grade_uuid_trans_with_locale');

            $table->foreignUuid('grade_uuid')->references('uuid')
                ->on('grades')->onDelete('cascade');
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
        Schema::dropIfExists('grade_translations');
    }
}
