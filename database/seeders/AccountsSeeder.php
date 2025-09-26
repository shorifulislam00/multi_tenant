<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\Account::insert([
            ['name' => 'Cash', 'acc_number' => '001', 'branch_name' => 'Cash', 'opening_balance' => 100, 'balance' => 100],
        ]);

    }
}
