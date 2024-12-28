<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->truncate();
        DB::table('statuses')->insert([
            ['user_status_id' => 1, 'user_status_name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['user_status_id' => 2,'user_status_name' => 'user', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
