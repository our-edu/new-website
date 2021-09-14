<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complain_statuses', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('complain_uuid')
                ->references('uuid')
                ->on('complains');
            $table->foreignUuid('user_uuid')
                ->references('uuid')
                ->on('users');
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
        Schema::dropIfExists('complain_translations');
    }
}
