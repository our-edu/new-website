<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUniqueColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropUnique(['mobile']);
            $table->dropUnique(['email']);
            $table->dropUnique(['national_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->index()->change();
            $table->string('mobile')->nullable()->unique()->index()->change();
            $table->string('email')->unique()->index()->change();
            $table->string('national_id')->unique()->change();
        });
    }
}
