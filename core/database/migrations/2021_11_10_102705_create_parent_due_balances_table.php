<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentDueBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_due_balances', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('parent_name',60);
            $table->string('national_id');
            $table->float('balance');//will mutate it by multiply it by 1000 and return divide it by 1000 when accessing
            $table->string('email');
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
        Schema::dropIfExists('parent_due_balances');
    }
}
