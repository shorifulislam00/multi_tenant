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
        Schema::table('flat_rents', function (Blueprint $table) {
            $table->decimal('meter_reading',10,2)->nullable()->after('advance_amount');
        });
    }


    public function down(): void
    {
        Schema::table('flat_rents', function (Blueprint $table) {
            $table->dropColumn('meter_reading');
        });
    }
};
