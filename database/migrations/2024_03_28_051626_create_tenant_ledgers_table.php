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
        Schema::create('tenant_ledgers', function (Blueprint $table) {
            $table->id();
            $table->date("action_date");
            $table->integer('flat_rent_id')->unsigned();
			$table->integer('account_id')->unsigned();
            $table->integer('year_id')->nullable();
			$table->integer('month_id')->nullable();
            $table->decimal("dr", 10, 2)->nullable()->unsigned()->comment('Receiver');
            $table->decimal("cr", 10, 2)->nullable()->unsigned()->comment('Giver');
            $table->string("comment")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_ledgers');
    }
};
