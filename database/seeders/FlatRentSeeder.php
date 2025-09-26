<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlatRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\FlatRent::insert([
            ['house_id' => 1, 'floor_id' => 1, 'flat_id' => 1, 'rent_date' => '2025-09-01', 'tenant_name' => 'Sabbir', 'mobile_no' => '01863792733', 'email' => 'sabbir@gmail.com', 'address' => 'Dhaka, Bangladesh', 'advance_amount' => 25000, 'rent_amount' => 13000, 'meter_reading' => 3267, 'status' => 'running', 'created_by' => 1],
        ]);

    }
}
