<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'ahammed',
            'user_role_name' => 'admin',
            'user_plan_type' => 1,
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
        ]);
    }
}
