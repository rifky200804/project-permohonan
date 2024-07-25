<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'user',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Verifikator',
                'email' => 'verifikator@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'verifikator',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Direktur',
                'email' => 'direktur@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'direktu',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'super admin',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ],
        ]);
    }
}
