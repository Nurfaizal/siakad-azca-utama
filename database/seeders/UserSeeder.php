<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ============================ User ==========================

        DB::table('user')->insert([
            'id_user' => '1',
            'username' => 'Nurfaizal',
            'email' => 'nurfaizal145@gmail.com',
            'password' => Hash::make('123123'),
            'status' => 'Aktif',
        ]);
    }
}
