<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSupervisorUuidToBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->dropForeign('buses_supervisor_uuid_foreign');
            $table->foreignUuid('supervisor_uuid')->nullable()->change()->references('uuid')
                ->on('bus_supervisors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->dropForeign('buses_supervisor_uuid_foreign');
            $table->foreignUuid('supervisor_uuid')->nullable()->change()->references('uuid')
                ->on('users')->onDelete('cascade');
        });
    }
}
