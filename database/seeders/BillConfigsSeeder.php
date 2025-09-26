<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\BillConfig::insert([
            ['name' => 'Rent Amount', 'type' => 1],
            ['name' => 'Electric Bill', 'type' => 2],
            ['name' => 'Water Bill', 'type' => 0],
            ['name' => 'Gas Bill', 'type' => 0],
            ['name' => 'Utility Bill', 'type' => 0],
        ]);

    }
}
