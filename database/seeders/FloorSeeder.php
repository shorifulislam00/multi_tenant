<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Floor::insert([
            ['house_id' => 1, 'name' => '1st Floor', 'created_by' => 1],
            ['house_id' => 1, 'name' => '2nd Floor', 'created_by' => 1],
        ]);

    }
}
