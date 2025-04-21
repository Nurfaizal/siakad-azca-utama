<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ========================= Room =======================================

        DB::table('room')->insert(
            [
                // 1
                [
                    'name' => 'A.101',
                    'status' => 'Aktif',
                ],
                // 2
                [
                    'name' => 'A.201',
                    'status' => 'Aktif',
                ],
                // 3
                [
                    'name' => 'A.301',
                    'status' => 'Aktif',
                ],
            ]
        );
    }
}
