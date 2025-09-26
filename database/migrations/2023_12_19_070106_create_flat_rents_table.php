<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlatRentsTable extends Migration {

	public function up()
	{
		Schema::create('flat_rents', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('flat_id')->unsigned();
			$table->string('tenant_name', 255);
			$table->string('mobile_no', 25);
			$table->string('email', 50)->nullable();
			$table->string('address', 255)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('flat_rents');
	}
}