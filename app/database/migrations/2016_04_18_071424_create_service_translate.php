<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTranslate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("services_translate",function($table){
			$table->increments("id");
			$table->integer("service_id")->unsigned();
			$table->string("name",200);
			$table->text("description");
			$table->string("lang_code",2);
			$table->foreign("service_id")->references("id")->on("services")->onDelete("cascade");
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
		Schema::drop("services_translate");
	}

}
