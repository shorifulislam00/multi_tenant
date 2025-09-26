<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('electric_meter_readings', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('house_id')->unsigned();
			$table->integer('flat_id')->unsigned();
			$table->integer('year_id')->nullable();
			$table->integer('month_id')->nullable();
			$table->integer('previous_meter_reading')->nullable();
			$table->integer('present_meter_reading')->nullable();
			$table->decimal('rate', 8,2);
			$table->decimal('amount', 10,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electric_meter_readings');
    }
};
