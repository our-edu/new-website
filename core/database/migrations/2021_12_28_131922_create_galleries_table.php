<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateGalleriesTable extends Migration {

	public function up()
	{
		Schema::create('galleries', function(Blueprint $table) {
            $table->uuid('uuid')->primary();
			$table->string('title')->nullable();
			$table->string('description')->nullable();
			$table->string('slug');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('galleries');
	}
}