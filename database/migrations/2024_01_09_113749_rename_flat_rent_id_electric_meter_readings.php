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
        if (Schema::hasColumn('electric_meter_readings', 'flat_id')) {
            Schema::table('electric_meter_readings', function (Blueprint $table) {
                $table->renameColumn('flat_id', 'flat_rent_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('electric_meter_readings', 'flat_rent_id')) {
            Schema::table('electric_meter_readings', function (Blueprint $table) {
                $table->renameColumn('flat_rent_id', 'flat_id');
            });
        }
    }
};
