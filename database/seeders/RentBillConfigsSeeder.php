<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentBillConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\RentBillConfig::insert([
            ['flat_rent_id' => 1, 'bill_config_id' => 1, 'amount' => 13000],
            ['flat_rent_id' => 1, 'bill_config_id' => 2, 'amount' => 0],
            ['flat_rent_id' => 1, 'bill_config_id' => 4, 'amount' => 1200],
            ['flat_rent_id' => 1, 'bill_config_id' => 5, 'amount' => 700],
        ]);

    }
}
