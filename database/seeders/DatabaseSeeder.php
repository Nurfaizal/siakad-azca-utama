<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Level;
use App\Models\SemesterType;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class, // 1
            DocumentCategoriesSeeder::class, // 2
            ReligionSeeder::class, // 3
            SchoolYearSeeder::class, // 4
            SkillProgramSeeder::class, // 5
            ExamCategoriesSeeder::class, // 6
            RoomSeeder::class, // 7
            SubjectContentSeeder::class, //8
            SemesterTypeSeeder::class, // 9
            StaffDivisionSeeder::class, // 10
            LevelSeeder::class, // 11
            StaffSeeder::class, // 12
        ]);

        // Staff 10 orang
        // Staff::factory()->count(5)->state(['gender' => 'laki-laki'])->create();
        // Staff::factory()->count(5)->state(['gender' => 'perempuan'])->create();

        // 6 Kelas
        // Classes::factory(6)->create();

        // 10 siswa per kelas
        // Classes::all()->each(function ($class) {
        //     $gender = str_contains($class->name, 'Ikhwan') ? 'laki-laki' : 'perempuan';
        //     Student::factory(10)->state([
        //         'gender' => $gender,
        //         'id_class' => $class->id_class,
        //     ])->create();
        // });
    }
}
