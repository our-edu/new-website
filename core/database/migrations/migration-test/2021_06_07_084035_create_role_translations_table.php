<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_translations', function (Blueprint $table) {
            $table->uuid('uuid');
	        $table->primary('uuid');

            $table->string('display_name')->nullable();

            $table->string('locale')->index();

            $table->unique(['role_id','locale'] ,'role_id_trans_with_locale');

            $table->foreignUuid('role_id')->references('id')
                ->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('role_translations');
    }
}
