<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Bill::insert([
            ['action_date' => '2025-09-01', 'flat_rent_id' => 1, 'year_id' => 2025, 'month_id' => 9, 'amount' => 14923.4, 'is_paid' => 0],
        ]);

    }
}
