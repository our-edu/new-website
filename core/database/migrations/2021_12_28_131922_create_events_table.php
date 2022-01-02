<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateEventsTable extends Migration {

	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
            $table->uuid('uuid')->primary();
			$table->string('title', 255);
			$table->string('description', 255);
			$table->string('slug');
            $table->string('event_img')->nullable();
            $table->date('event_date');
			$table->time('start_time');
			$table->time('end_time');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('events');
	}
}