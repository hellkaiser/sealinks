<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTranslate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("locations_translate",function($table){
			$table->increments("id");
			$table->integer("location_id")->unsigned();
			$table->string("lang_code",2);
			$table->string("name",250);
			$table->foreign("location_id")->references("id")->on("locations")->onDelete("cascade");
			$table->foreign("lang_code")->references("code")->on("languages")->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("locations_translate");
	}

}
