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
		

	}
}
