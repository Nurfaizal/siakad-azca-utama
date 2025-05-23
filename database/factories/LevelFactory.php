<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::factory(), // akan membuat user baru jika tidak diberikan
            'level' => $this->faker->randomElement([
                'yayasan',
                'admin',
                'guru sma',
                'guru smp',
                'guru sd',
                'guru tk',
                'staff',
                'siswa',
                'wali'
            ]),
        ];
    }
}
