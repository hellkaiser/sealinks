<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContact extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("contacts",function($table){
			$table->increments("id");
			$table->string("address");
			$table->string("phone");
			$table->string("fax");
			$table->string("email");
			$table->integer("location_id")->unsigned();
			$table->foreign("location_id")->references("id")->on("locations")->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("contacts");
	}

}
