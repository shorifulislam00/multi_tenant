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
            $table->integer('rent_amount')->nullable()->after('advance_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flat_rents', function (Blueprint $table) {
            $table->dropColumn('rent_amount');
        });
    }
};
