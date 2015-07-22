<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_categories', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('thumbnail')->nullable();
            $table->string('name')->unique();
            $table->string('alias')->unique();
            $table->text('description')->nullable();
            $table->integer('position')->unsigned();
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
		Schema::drop('blog_categories');
	}

}
