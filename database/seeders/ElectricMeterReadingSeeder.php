<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectricMeterReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ElectricMeterReading::insert([
            ['house_id' => 1, 'flat_rent_id' => 1, 'year_id' => 2025, 'month_id' => 9, 'previous_meter_reading' => 3267, 'present_meter_reading' => 3270, 'rate' => 7.8, 'amount' => 23.4],
            ['house_id' => 1, 'flat_rent_id' => 1, 'year_id' => 2025, 'month_id' => 10, 'previous_meter_reading' => 3270, 'present_meter_reading' => null, 'rate' => 7.8, 'amount' => null],
        ]);

    }
}
