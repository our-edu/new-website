<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications_log', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('type');
            $table->string('reason');
            $table->foreignUuid('parent_uuid')
                ->references('uuid')
                ->on('parent_users');
            $table->date('date');
            $table->string('procedure')->nullable();
            $table->foreignUuid('branch_uuid')
                ->references('uuid')
                ->on('branches');
            $table->softDeletes();
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
        Schema::dropIfExists('communications_log');
    }
}
