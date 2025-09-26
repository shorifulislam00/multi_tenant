<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\House::insert([
            ['name' => 'Banasree E-1', 'start_date' => '2025-09-01', 'address' => 'Banasree, Dhaka, Bangladesh', 'description' => null, 'business_electric_bill' => 9.8, 'domestic_electric_bill' => 7.8, 'created_by' => 1],
        ]);

    }
}
