<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =========================== Subject Content ===========================

        DB::table('subject_content')->insert(
            [
                // 1
                [
                    'name' => 'Muatan Nasional',
                    'status' => 'Aktif',
                ],
                // 2
                [
                    'name' => 'Muatan Wilayah',
                    'status' => 'Aktif',
                ],
                // 3
                [
                    'name' => 'Muatan Kejuruan',
                    'status' => 'Aktif',
                ],
                // 4 
                [
                    'name' => 'Muatan Lokal',
                    'status' => 'Aktif',
                ],
            ]
        );
    }
}
