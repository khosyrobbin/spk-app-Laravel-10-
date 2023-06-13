<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin1',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('123456789'),
                'level' => '1',
            ],
            [
                'name' => 'Admin3',
                'email' => 'admin3@gmail.com',
                'password' => bcrypt('123456789'),
                'level' => '1',
            ],
            [
                'name' => 'Admin2',
                'email' => 'admin2@gmail.com',
                'password' => bcrypt('123456789'),
                'level' => '1',
            ],
        ];
        DB::table('users')->insert($user);
        // php artisan db:seed --class=DatabaseSeeder
    }
}
