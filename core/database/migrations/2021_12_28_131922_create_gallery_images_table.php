<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateGalleryImagesTable extends Migration {

	public function up()
	{
		Schema::create('gallery_images', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('gallery_images');
	}
}