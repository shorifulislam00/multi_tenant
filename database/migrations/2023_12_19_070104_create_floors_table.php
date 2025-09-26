<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFloorsTable extends Migration {

	public function up()
	{
		Schema::create('floors', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('house_id')->unsigned();
			$table->string('name', 255);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('floors');
	}
}