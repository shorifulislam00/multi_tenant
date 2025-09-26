<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlatRentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\FlatRentDetail::insert([
            ['rent_bill_config_id' => 1, 'bill_id' => 1, 'amount' => 700],
            ['rent_bill_config_id' => 2, 'bill_id' => 1, 'amount' => 1200],
            ['rent_bill_config_id' => 3, 'bill_id' => 1, 'amount' => 13000],
            ['rent_bill_config_id' => 4, 'bill_id' => 1, 'amount' => 23.4],
        ]);

    }
}
