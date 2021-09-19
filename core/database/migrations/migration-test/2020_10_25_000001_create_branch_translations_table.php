<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_translations', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->string('name')->nullable();

            $table->string('locale')->index();

            $table->unique(['branch_uuid','locale'] ,'branch_uuid_trans_with_locale');

            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches')->onDelete('cascade');
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
        Schema::dropIfExists('branch_translations');
    }
}
