<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ===================== Religion ==============================

        DB::table('religion')->insert([
            'name' => 'Islam',
            'status' => 'Aktif',
        ]);
    }
}
