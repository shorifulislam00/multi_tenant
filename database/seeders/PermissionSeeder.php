<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table("permissions")->insert([
            // 1
            [
                "name" => "dashboard_view",
                "guard_name" => "web",
            ],

            // account
            // 2
            [
                "name" => "account_view",
                "guard_name" => "web",
            ],
            // 3
            [
                "name" => "account_edit",
                "guard_name" => "web",
            ],
            // 4
            [
                "name" => "account_delete",
                "guard_name" => "web",
            ],
            // 5
            [
                "name" => "account_balance",
                "guard_name" => "web",
            ],
            // 6
            [
                "name" => "account_ledger",
                "guard_name" => "web",
            ],

            
            // rent
            // 7
            [
                "name" => "rent_view",
                "guard_name" => "web",
            ],
            // 8
            [
                "name" => "rent_edit",
                "guard_name" => "web",
            ],
            // 9
            [
                "name" => "rent_delete",
                "guard_name" => "web",
            ],



            // bill
            // 10
            [
                "name" => "bill_generate_view",
                "guard_name" => "web",
            ],

            // 11
            [
                "name" => "bill_view",
                "guard_name" => "web",
            ],

            // 12
            [
                "name" => "bill_print",
                "guard_name" => "web",
            ],

            // 13
            [
                "name" => "bill_delete",
                "guard_name" => "web",
            ],

            // bill category
            // 14
            [
                "name" => "bill_category_list_view",
                "guard_name" => "web",
            ],
            // 15
            [
                "name" => "bill_category_edit",
                "guard_name" => "web",
            ],
            // 16
            [
                "name" => "bill_category_delete",
                "guard_name" => "web",
            ],

             // bill payment
            //  17
             [
                "name" => "bill_payment_list_view",
                "guard_name" => "web",
            ],
            // 18
            [
                "name" => "bill_payment_edit",
                "guard_name" => "web",
            ],
            // 19
            [
                "name" => "bill_payment_delete",
                "guard_name" => "web",
            ],

            // flatt bill ledger
            // 20
            [
                "name" => "bill_ledger_view",
                "guard_name" => "web",
            ],


            // house
            // 21
            [
                "name" => "house_view",
                "guard_name" => "web",
            ],
            // 22
            [
                "name" => "house_edit",
                "guard_name" => "web",
            ],
            // 23
            [
                "name" => "house_delete",
                "guard_name" => "web",
            ],

             // floor
            // 24
            [
                "name" => "floor_view",
                "guard_name" => "web",
            ],
            // 25
            [
                "name" => "floor_edit",
                "guard_name" => "web",
            ],
            // 26
            [
                "name" => "floor_delete",
                "guard_name" => "web",
            ],

            // flat
            // 27
            [
                "name" => "flat_view",
                "guard_name" => "web",
            ],
            // 28
            [
                "name" => "flat_edit",
                "guard_name" => "web",
            ],
            // 29
            [
                "name" => "flat_delete",
                "guard_name" => "web",
            ],


            // user
            // 30
            [
                "name" => "user_view",
                "guard_name" => "web",
            ],
            // 31
            [
                "name" => "user_edit",
                "guard_name" => "web",
            ],
            // 32
            [
                "name" => "user_delete",
                "guard_name" => "web",
            ],

        ]);

    }
}
