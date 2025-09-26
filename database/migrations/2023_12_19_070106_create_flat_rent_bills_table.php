<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlatRentBillsTable extends Migration {

	public function up()
	{
		Schema::create('flat_rent_bills', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('rent_bill_config_id')->unsigned();
			// $table->integer('transaction_id')->unsigned();
			$table->decimal('amount', 10,4);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('flat_rent_bills');
	}
}
