<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'mail@mail.com',
            'password' => '$2y$10$bMq3k63wQKATRlfyVhyZ.Oczw6phjNUO8vpGEp301wyhFFzkRyk6y',
        ]);
    }
}
