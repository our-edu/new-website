<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->float('amount', 8, 2)->nullable();
            $table->float('min_payment', 8, 2)->nullable();
            $table->timestamp('payed_at')->nullable();
            $table->string('notes'); //bill for
            $table->json('details')->nullable();
            $table->foreignUuid('schedule_payment_id')->references('uuid')
                ->on('schedule_payments');
            $table->foreignUuid('payer_id')->references('uuid')
                ->on('users');
            $table->foreignUuid('bill_id')->references('uuid')
                ->on('bills');
            $table->foreignUuid('marked_payed_by')->nullable()->references('uuid')
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
        Schema::dropIfExists('payments');
    }
}
