<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
	{
		Schema::create('flats', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('house_id')->unsigned();
			$table->integer('floor_id')->unsigned();
			$table->enum('type', array('shop', 'apartment'));
			$table->string('flat_number', 50);
			$table->string('sqr_feet', 50)->nullable();
			$table->text('description')->nullable();
			$table->bigInteger('sell_rate')->nullable();
			$table->integer('rent_amount')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
};
