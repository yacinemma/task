<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_ar', 150);
			$table->string('name_en', 150);
			$table->timestamps();
			$table->integer('parent_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}