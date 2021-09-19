<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceGradeUuidToServiceOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_order_items', function (Blueprint $table) {
            //
            $table->foreignUuid('service_grade_uuid')->nullable()->references('uuid')
                ->on('services_grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_order_items', function (Blueprint $table) {
            $table->dropColumn('service_grade_uuid');
        });
    }
}
