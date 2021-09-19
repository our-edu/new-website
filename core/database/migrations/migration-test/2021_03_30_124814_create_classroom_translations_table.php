<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->string('name');

            $table->string('locale')->index();

            $table->unique(['classroom_uuid','locale'] ,'classroom_id_trans_with_locale');

            $table->foreignUuid('classroom_uuid')->references('uuid')
                ->on('classrooms');
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
        Schema::dropIfExists('classroom_translations');
    }
}
