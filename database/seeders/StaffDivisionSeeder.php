<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ======================== Staff Division ============================

        DB::table('staff_division')->insert(
            [
                // 1
                [
                    'name' => 'Guru',
                    'time_in' => '07:30:00',
                    'time_out' => '13:00:00',
                ],
                // 2
                [
                    'name' => 'Tata Usaha',
                    'time_in' => '08:00:00',
                    'time_out' => '14:00:00',
                ],
                // 3
                [
                    'name' => 'Staff Lainnya',
                    'time_in' => '08:00:00',
                    'time_out' => '14:00:00',
                ]
            ]
        );
    }
}
