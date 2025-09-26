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
        Schema::table('accounts', function (Blueprint $table) {

            $table->decimal('opening_balance',20,4)->unsigned()->after('branch_name');
            $table->decimal('balance', 20,4)->unsigned()->after('opening_balance');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('opening_balance');
            $table->dropColumn('balance');
        });
    }
};
