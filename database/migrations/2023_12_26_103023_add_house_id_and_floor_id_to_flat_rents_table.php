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
            $table->integer('house_id')->after('id');
            $table->integer('floor_id')->after('house_id');

            // $table->foreign('house_id')->references('id')->on('houses')->constrained()
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
            // $table->foreign('floor_id')->references('id')->on('floors')->constrained()
            // ->onUpdate('cascade')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flat_rents', function (Blueprint $table) {
            $table->dropColumn(['house_id','floor_id']);
            // $table->dropForeign(['house_id','floor_id']);
        });
    }
};
