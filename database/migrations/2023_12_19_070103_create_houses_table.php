<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHousesTable extends Migration {

	public function up()
	{
		Schema::create('houses', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->date('start_date')->nullable();
			$table->string('address', 255)->nullable();
			$table->string('description', 255)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('houses');
	}
}