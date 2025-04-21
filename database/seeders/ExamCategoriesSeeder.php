<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ======================== Exam Category =============================

        DB::table('exam_categories')->insert(
            [
                // 1
                [
                    'name' => 'UTS',
                    'status' => 'Aktif',
                ],
                // 2
                [
                    'name' => 'UAS',
                    'status' => 'Aktif',
                ]
            ]
        );
    }
}
