<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements_roles', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('announcement_uuid')->references('uuid')
                ->on('announcements');
            $table->foreignUuid('branch_uuid')->references('uuid')
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
        Schema::dropIfExists('announcements_roles');
    }
}
