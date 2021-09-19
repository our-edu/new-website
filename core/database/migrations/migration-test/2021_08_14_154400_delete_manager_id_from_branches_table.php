<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteManagerIdFromBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('branches', 'manager_id')) {
            Schema::table('branches', function (Blueprint $table) {
                $table->dropForeign(['manager_uuid']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('branches', 'manager_id')) {
            Schema::table('branches', function (Blueprint $table) {
                $table->foreignUuid('manager_uuid')->references('uuid')
                    ->on('users')->onDelete('cascade');
            });
        }
    }
}
