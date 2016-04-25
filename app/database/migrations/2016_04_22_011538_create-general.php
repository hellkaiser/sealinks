<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneral extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("general",function($table){
			$table->string("title",200)->default("");
			$table->text("description")->default("");
			$table->string("keyword")->default("");
			$table->boolean("is_index")->default(1);
			$table->string("lang_sys",2)->default("vn");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("general");
	}

}
