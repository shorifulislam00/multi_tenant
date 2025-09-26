<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(BillConfigsSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(ModelHasPermissionSeeder::class);
        $this->call(AccountsSeeder::class);
        $this->call(AccountLedgerSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(FloorSeeder::class);
        $this->call(FlatSeeder::class);
        $this->call(FlatRentSeeder::class);
        $this->call(RentBillConfigsSeeder::class);
        $this->call(TenantLedgerSeeder::class);
        $this->call(ElectricMeterReadingSeeder::class);
        $this->call(BillsSeeder::class);
        $this->call(FlatRentDetailSeeder::class);
    }
}
