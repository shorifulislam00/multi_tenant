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
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->date("action_date");
            $table->enum('type', ['payment', 'withdraw', 'collection', 'expense', 'income', 'transfer', 'loan']);
            $table->bigInteger("expense_id")->nullable()->unsigned();
            $table->bigInteger("account_id")->nullable()->unsigned();
            $table->bigInteger("reff_id")->nullable()->unsigned();
            $table->string("comment")->nullable();
            $table->decimal("dr", 10, 2)->nullable()->unsigned()->comment('Receiver');
            $table->decimal("cr", 10, 2)->nullable()->unsigned()->comment('Giver');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_account_ledgers');
    }
};
