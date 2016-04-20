<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationService extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("location_service",function($table){
			$table->increments("id");
			$table->integer("location_id")->unsigned();
			$table->integer("service_id")->unsigned();
			$table->foreign("location_id")->references("id")->on("locations")->onDelete("cascade");
			$table->foreign("service_id")->references("id")->on("services")->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("location_service");
	}

}
