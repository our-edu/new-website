<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentProductConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_product_config', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('product_uuid')->references('uuid')
                ->on('products')->onDelete('cascade');

            $table->foreignUuid('student_uuid')->references('uuid')
                ->on('students')->onDelete('cascade');
            $table->boolean('is_prohibited')->default(0);
            $table->integer('order_limit_per_day')->nullable();
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
        Schema::dropIfExists('student_product_config');
    }
}
