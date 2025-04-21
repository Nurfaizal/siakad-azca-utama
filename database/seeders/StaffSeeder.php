<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('staff')->insert([
            'nip' => '202501001',
            'name' => 'Nurfaizal',
            'id_user' => '1',
            'place_birth' => 'Maros',
            'birth_date' => Carbon::create('2003', '02', '15'),
            'gender' => 'Laki-laki',
            'address' => 'Maros',
            'join_date' => Carbon::create('2025', '01', '01'),
            'end_date' => Carbon::create('2030', '01', '01'),
            'no_ktp' => '7309089012300001',
            'phone' => '081523777644',
            'education' => 'S1',
            'salary' => 500000,
            'id_division' => '3',
            'status' => 'Tetap',
            'part' => 'Staff',
            'card_number' => '202501001',

        ]);
    }
}
