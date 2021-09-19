<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchWorkingHourTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_working_hour_translations', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->foreignUuid('branch_working_hour_uuid')->references('uuid')
                ->on('branch_working_hours');
            $table->string('working_hours');
            $table->string('locale')->index();
            $table->unique(['branch_working_hour_uuid','locale'] ,'branch_working_hour_uuid_trans_with_locale');
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
        Schema::dropIfExists('branch_working_hour_translations');
    }
}
