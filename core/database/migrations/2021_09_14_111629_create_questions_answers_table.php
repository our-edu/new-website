<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains_questions_answers', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('value');
            $table->foreignUuid('complain_uuid')
                ->nullable()
                ->references('uuid')
                ->on('complains');
            $table->foreignUuid('parent_uuid')
                ->references('uuid')
                ->on('parent_users');
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
        Schema::dropIfExists('complains_questions_answers');
    }
}
