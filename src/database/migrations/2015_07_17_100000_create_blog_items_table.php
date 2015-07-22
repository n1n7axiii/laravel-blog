<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_items', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('title')->unique();
            $table->string('alias')->unique();
            $table->string('thumbnail')->nullable();
            $table->text('short_description')->nullable();
            $table->mediumText('content')->nullable();
            $table->integer('position')->unsigned();
            $table->tinyInteger('highlight')->default(0);
			$table->timestamps();

            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blog_items');
	}

}
