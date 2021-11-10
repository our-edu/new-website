<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable()->unique()->index();
            $table->string('profile_picture')->nullable();
            $table->string('mobile')->nullable()->unique()->index();
            $table->string('email')->nullable()->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->default('active');
            $table->string('national_id')->unique();
            $table->string('language')->default('ar');
            $table->uuid('created_by')->nullable()->index();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
