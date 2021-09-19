<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_payments', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->float('amount', 8, 2)->nullable();
            $table->boolean('payed')->default(0);
            $table->date('due_date')->nullable();
            $table->foreignUuid('payer_id')->references('uuid')
                ->on('users');
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
        Schema::dropIfExists('schedule_payments');
    }
}
