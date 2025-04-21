<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ======================== Semester Type ============================

        DB::table('semester_type')->insert(
            [
                // 1
                [
                    'name' => 'Penilaian Tengah Semester (PTS)',
                    'status' => 'Aktif',
                ],
                // 2
                [
                    'name' => 'Penilaian Akhir Semester (PAS)',
                    'status' => 'Aktif',
                ],
                // 3
                [
                    'name' => 'Penilaian Akhir Tahun (PAT)',
                    'status' => 'Non-Aktif',
                ]
            ]
        );
    }
}
