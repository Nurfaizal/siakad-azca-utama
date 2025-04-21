<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Staff::class;
    public function definition(): array
    {

        $user = User::factory()->create(); // Buat user manual agar bisa dipakai untuk Level

        // Buat Level untuk user ini
        Level::factory()->create([
            'id_user' => $user->id_user,
            'level' => $this->faker->randomElement([
                'guru sma',
                'guru smp',
                'guru sd',
                'guru tk',
            ]),
        ]);

        return [
            'nip' => $this->faker->unique()->numerify('198#####'),
            'name' => $this->faker->name,
            'id_user' => $user->id_user,
            'place_birth' => $this->faker->city,
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'address' => $this->faker->address,
            'image' => null,
            'join_date' => $this->faker->date(),
            'end_date' => $this->faker->dateTimeBetween('+1 years', '+2 years')->format('Y-m-d'),
            'no_ktp' => $this->faker->numerify('32##########'),
            'phone' => $this->faker->phoneNumber,
            'education' => $this->faker->randomElement(['SMA', 'D3', 'S1']),
            'salary' => 4000000,
            'id_division' => 1,
            'status' => $this->faker->randomElement(['PNS', 'Honorer']),
            'part' => 'guru',
            'card_number' => $this->faker->numerify('CARD####'),
            'staff_status' => 'aktif',
        ];
    }
}
