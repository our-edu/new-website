<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingPaymentServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_payment_services', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->float('amount', 8, 2)->nullable();
            $table->foreignUuid('service_id')->nullable()->references('uuid')
                ->on('services');
            $table->foreignUuid('bill_id')->references('uuid')
                ->on('bills');

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
        Schema::dropIfExists('pending_payment_services');
    }
}
