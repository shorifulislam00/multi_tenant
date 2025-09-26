<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRentBillConfigsTable extends Migration {

	public function up()
	{
		Schema::create('rent_bill_configs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('flat_rent_id')->unsigned();
			$table->integer('bill_config_id')->unsigned();
			$table->decimal('amount', 10,4);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('rent_bill_configs');
	}
}