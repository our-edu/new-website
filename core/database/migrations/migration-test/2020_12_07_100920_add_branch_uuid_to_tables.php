<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchUuidToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canteens', function (Blueprint $table) {
            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches')->onDelete('cascade');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignUuid('branch_uuid')->references('uuid')
                ->on('branches')->onDelete('cascade');

            $table->foreignUuid('parent_id')->nullable()->references('uuid')
                ->on('products')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('canteens', function (Blueprint $table) {
            $table->dropColumn('branch_uuid');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('branch_uuid');
            $table->dropColumn('parent_id');
        });

    }
}
