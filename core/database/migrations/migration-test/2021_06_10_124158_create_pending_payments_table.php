<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_payments', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('merchant_reference')->nullable();
            $table->float('amount', 8, 2)->nullable();
            $table->tinyInteger('moved')->default(0);
            $table->timestamp('payed_at')->nullable();
            $table->string('notes'); //bill for
            $table->json('details')->nullable();

            $table->foreignUuid('payer_id')->nullable()->references('uuid')
                ->on('users');
            $table->foreignUuid('bill_id')->nullable()->references('uuid')
                ->on('bills');
            $table->foreignUuid('marked_payed_by')->nullable()->references('uuid')
                ->on('users');
            $table->foreignUuid('payment_id')->nullable()->references('uuid')
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
        Schema::dropIfExists('pending_payments');
    }
}
