<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_translations', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->foreignUuid('payment_method_uuid')->references('uuid')
                ->on('payment_methods');
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['payment_method_uuid','locale'] ,'payment_method_uuid_trans_with_locale');
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
        Schema::dropIfExists('payment_method_translations');
    }
}
