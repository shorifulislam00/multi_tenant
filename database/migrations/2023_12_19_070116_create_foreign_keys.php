<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{



		Schema::table('floors', function(Blueprint $table) {
			$table->foreign('house_id')->references('id')->on('houses')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('flats', function(Blueprint $table) {
			$table->foreign('house_id')->references('id')->on('houses')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('flats', function(Blueprint $table) {
			$table->foreign('floor_id')->references('id')->on('floors')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('flat_rents', function(Blueprint $table) {
			$table->foreign('flat_id')->references('id')->on('flats')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('rent_bill_configs', function(Blueprint $table) {
			$table->foreign('flat_rent_id')->references('id')->on('flat_rents')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('rent_bill_configs', function(Blueprint $table) {
			$table->foreign('bill_config_id')->references('id')->on('bill_configs')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('flat_rent_bills', function(Blueprint $table) {
			$table->foreign('rent_bill_config_id')->references('id')->on('rent_bill_configs')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

	}

	public function down()
	{

		Schema::table('floors', function(Blueprint $table) {
			$table->dropForeign('floors_house_id_foreign');
		});
		Schema::table('flats', function(Blueprint $table) {
			$table->dropForeign('flats_floor_id_foreign');
		});
		Schema::table('flat_rents', function(Blueprint $table) {
			$table->dropForeign('flat_rents_flat_id_foreign');
		});
		Schema::table('rent_bill_configs', function(Blueprint $table) {
			$table->dropForeign('rent_bill_configs_flat_rent_id_foreign');
		});
		Schema::table('rent_bill_configs', function(Blueprint $table) {
			$table->dropForeign('rent_bill_configs_bill_config_id_foreign');
		});
		Schema::table('flat_rent_bills', function(Blueprint $table) {
			$table->dropForeign('flat_rent_bills_rent_bill_config_id_foreign');
		});

	}
}
