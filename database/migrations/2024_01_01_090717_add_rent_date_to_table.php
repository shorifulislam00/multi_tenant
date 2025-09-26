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
            $table->date('rent_date')->nullable()->after('flat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flat_rents', function (Blueprint $table) {
            $table->dropColumn('rent_date');
        });
    }
};
