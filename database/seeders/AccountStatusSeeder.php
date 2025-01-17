<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->truncate();
        DB::table('accounts')->insert([
            ['account_status_id' => 1, 'account_status_name' => 'Active'],
            ['account_status_id' => 2, 'account_status_name' => 'Inactive'],
        ]);
    }
}
