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
        Schema::table('bill_configs', function (Blueprint $table) {
            $table->tinyInteger('type')
                ->default(0)
                ->comment('1: rent amount, 2: electric bill')
                ->after('name');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_configs', function (Blueprint $table) {
            $table->dropColumn('type');

        });
    }
};
