<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name_ar', 250);
			$table->string('name_en', 250);
			$table->integer('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}