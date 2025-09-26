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
        Schema::create('flat_rent_details', function (Blueprint $table) {
            $table->id();
            $table->integer('rent_bill_config_id')->unsigned();
			$table->integer('bill_id')->unsigned();
			$table->decimal('amount', 10,4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flat_rent_details');
    }
};
