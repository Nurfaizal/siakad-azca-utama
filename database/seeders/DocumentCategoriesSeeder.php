<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =================== Document Category =======================

        DB::table('document_category')->insert(
            [
                // 1
                [
                    'name' => 'SKL',
                    'type' => 'e-document-siswa',
                    'status' => 'Aktif',
                ],
                // 2
                [
                    'name' => 'E-Raport',
                    'type' => 'e-document-siswa',
                    'status' => 'Aktif',
                ],
                // 3
                [
                    'name' => 'Slip Gaji',
                    'type' => 'e-document-staff',
                    'status' => 'Aktif',
                ],
                // 4
                [
                    'name' => 'Ijazah',
                    'type' => 'e-document-staff',
                    'status' => 'Aktif',
                ],
                // 5
                [
                    'name' => 'Ujian',
                    'type' => 'ujian/tugas',
                    'status' => 'Aktif',
                ],
                // 6
                [
                    'name' => 'Tugas',
                    'type' => 'ujian/tugas',
                    'status' => 'Aktif',
                ],
                // 7
                [
                    'name' => 'Tamu Sekolah',
                    'type' => 'buku tamu',
                    'status' => 'Aktif',
                ],
                // 8
                [
                    'name' => 'Tamu Dinas',
                    'type' => 'buku tamu',
                    'status' => 'Aktif',
                ],
                // 9
                [
                    'name' => 'Meeting',
                    'type' => 'buku tamu',
                    'status' => 'Aktif',
                ]
            ]
        );
    }
}
