<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->float('amount', 8, 2)->nullable();
            $table->float('min_payment', 8, 2)->default(0);
            $table->boolean('payed')->default(0);
            $table->timestamp('payed_at')->nullable();
            $table->boolean('must_pay_all')->default(0);
            $table->string('bill_type'); //(school_subscription,bus,pocket_money,....)
            $table->string('notes')->nullable();; //bill for
            $table->nullableUuidMorphs('serviceable');
            $table->json('details')->nullable(); //son of need fields for reference (received_student_id)
            $table->foreignUuid('payer')->references('uuid')
                ->on('users');
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
        Schema::dropIfExists('bills');
    }
}
