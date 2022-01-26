<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('title', 255);
            $table->string('description', 255);
            $table->text('research_content');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->boolean('is_active')->nullable()->index()->default(0);
            $table->boolean('is_featured')->nullable()->index()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('researches');
    }
}
