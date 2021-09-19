<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolAccountTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_account_translations', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');
            $table->foreignUuid('school_account_uuid')->references('uuid')
                ->on('school_accounts')->onDelete('cascade');;
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['school_account_uuid','locale'] ,'school_account_uuid_trans_with_locale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_account_translations');
    }
}
