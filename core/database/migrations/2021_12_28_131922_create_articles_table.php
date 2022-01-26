<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->uuid('uuid')->primary();
			$table->string('title', 255);
			$table->string('description', 255);
			$table->longText('article_content');
			$table->string('slug')->unique();
			$table->string('post_img')->nullable();
			$table->boolean('is_active')->nullable()->index()->default(0);
			$table->boolean('is_featured')->nullable()->index()->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}