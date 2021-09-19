<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('type'); //(school_subscription,bus,....)
            $table->timestamp('subscript_at')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->boolean('active')->default(0);
            $table->foreignUuid('user_id')->references('uuid')
                ->on('users');
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
        Schema::dropIfExists('subscriptions');
    }
}
