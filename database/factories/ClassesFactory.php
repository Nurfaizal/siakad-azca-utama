<?php

namespace Database\Factories;

use App\Models\SchoolYear;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Tentukan level
        $level = $this->faker->randomElement(['TK', 'SD', 'SMP', 'SMA']);

        // Tentukan grade berdasarkan level
        $grade = match ($level) {
            'TK' => 'TK',
            'SD' => (string) $this->faker->numberBetween(1, 6),
            'SMP' => (string) $this->faker->numberBetween(7, 9),
            'SMA' => (string) $this->faker->numberBetween(10, 12),
        };

        // Jenis kelamin kelas
        $gender = $this->faker->randomElement(['Ikhwan', 'Akhwat']);
        $suffix = $this->faker->randomElement(['A', 'B']);

        return [
            'name' => "K{$grade}-{$gender}-{$suffix}",
            'level' => $level,
            'id_skill' => null,
            'time_in' => "07:30",
            'time_out' => "13:00",
            'id_staff' => Staff::inRandomOrder()->first()?->id_staff,
            'id_year' => SchoolYear::firstWhere('status', 'Aktif')?->id_year ?? 1,
            'status' => 'aktif',
        ];
    }
}
