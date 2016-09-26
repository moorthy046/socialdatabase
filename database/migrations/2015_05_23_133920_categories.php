<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// blog table
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table -> integer('author_id') -> unsigned() -> default(0);
			$table->foreign('author_id')
					->references('id')->on('users')
					->onDelete('cascade');
			$table->string('category_name')->unique();
			$table->string('slug')->unique();
			$table->integer('count');
			$table->boolean('active');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop blog table
		Schema::drop('categories');
	}

}
