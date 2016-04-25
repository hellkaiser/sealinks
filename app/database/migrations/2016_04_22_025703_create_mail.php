<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMail extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("mail",function($table){
			$table->string("driver",100)->default("");
			$table->string("host",200)->default("");
			$table->integer("port")->default(0);
			$table->string("encryption",100)->default("");
			$table->string("address_from",200)->default("");
			$table->string("name_from",100)->default("");
			$table->string("email",200)->default("");
			$table->string("password",100)->default("");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("mail");
	}

}
