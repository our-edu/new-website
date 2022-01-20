<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBooksTable extends Migration {

	public function up()
	{
		Schema::create('books', function(Blueprint $table) {
            $table->uuid('uuid')->primary();
			$table->string('name');
			$table->string('description', 255);
			$table->string('slug')->unique();
			$table->boolean('is_featured')->nullable()->index()->default(0);
			$table->boolean('is_active')->nullable()->index()->default(0);
			$table->boolean('is_recommended')->nullable()->index()->default(0);
			$table->string('book_img')->nullable();
			$table->timestamps();
			$table->date('publish_date');
			$table->string('author')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('books');
	}
}