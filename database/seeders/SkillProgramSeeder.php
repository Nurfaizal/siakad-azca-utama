<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ======================== Skill Program ============================

        DB::table('skill_program')->insert(
            [
                // 1
                [
                    'name' => 'TKJ',
                    'status' => 'Aktif',
                ],
                // 2
                [
                    'name' => 'RPL',
                    'status' => 'Aktif',
                ],
                // 3
                [
                    'name' => 'Multimedia',
                    'status' => 'Non-Aktif',
                ]
            ]
        );
    }
}
