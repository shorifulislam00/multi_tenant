<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\TenantLedger::insert([
            ['action_date' => '2025-09-01', 'flat_rent_id' => 1, 'account_id' => 1, 'year_id' => 2025, 'month_id' => 9, 'comment' => 'Rent Advance', 'dr' => null, 'cr' => 25000],
            ['action_date' => '2025-09-01', 'flat_rent_id' => 1, 'account_id' => null, 'year_id' => 2025, 'month_id' => 9, 'comment' => 'Rent Bill', 'dr' => 14923.4, 'cr' => null],
        ]);

    }
}
