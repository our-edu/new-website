<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            $table->foreignUuid('parent_uuid')
                   ->references('uuid')
                   ->on('parent_users');

            $table->foreignUuid('student_uuid')
                ->references('uuid')
                ->on('students');
            $table->text('body');

            $table->string('status');

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
        Schema::dropIfExists('complains');
    }
}
