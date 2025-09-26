<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Flat::insert([
            ['house_id' => 1, 'floor_id' => 1, 'type' => 'shop', 'flat_number' => '1A', 'sqr_feet' => 250, 'rent_amount' => 13000, 'created_by' => 1],
            ['house_id' => 1, 'floor_id' => 2, 'type' => 'apartment', 'flat_number' => '2B', 'sqr_feet' => 750, 'rent_amount' => 15000, 'created_by' => 1],
        ]);

    }
}
