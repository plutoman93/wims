<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            ['username' => 'godmaster9999', 'email' => 'god@example.com', 'password' => bcrypt('132100123478')],
        ]);
    }
}
