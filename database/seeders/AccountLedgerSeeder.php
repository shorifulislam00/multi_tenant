<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\AccountLedger::insert([
            ['action_date' => '2025-09-01', 'type' => '', 'expense_id' => null, 'account_id' => 1, 'reff_id' => 1, 'comment' => 'Rent Advance', 'dr' => null, 'cr' => 15000],
            ['action_date' => '2025-09-01', 'type' => '', 'expense_id' => null, 'account_id' => null, 'reff_id' => 2, 'comment' => 'Rent Bill', 'dr' => 14923.4, 'cr' => null],
        ]);

    }
}
