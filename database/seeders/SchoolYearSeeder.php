<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==================== School Year ============================

        DB::table('school_year')->insert(
            [
                // 1
                [
                    'name' => '2024/2025 Ganjil',
                    'status' => 'Aktif',
                ],
                // 2
                [
                    'name' => '2024/2025 Genap',
                    'status' => 'Non-Aktif',
                ],
                // 3
                [
                    'name' => '2025/2026 Ganjil',
                    'status' => 'Non-Aktif',
                ],
                // 4
                [
                    'name' => '2025/2026 Genap',
                    'status' => 'Non-Aktif',
                ],
            ]
        );
    }
}
