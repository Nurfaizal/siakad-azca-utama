<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Guardian;
use App\Models\Level;
use App\Models\Religion;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;

    public function definition(): array
    {
        $user = User::factory()->create();

        Level::factory()->create([
            'id_user' => $user->id_user,
            'level' => 'siswa',
        ]);

        return [
            'id_user' => $user->id_user,
            'nisn' => $this->faker->unique()->numerify('00########'),
            'nis' => $this->faker->unique()->numerify('10######'),
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'place_birth' => $this->faker->city,
            'birth_date' => $this->faker->date(),
            'status' => 'Aktif',
            'gender' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'family_status' => $this->faker->randomElement(['Anak Kandung', 'Anak Tiri']),
            'child_order' => $this->faker->numberBetween(1, 4),
            'phone' => $this->faker->phoneNumber,
            'id_religion' => Religion::inRandomOrder()->first()->id_religion ?? 1,
            'prev_school' => $this->faker->optional()->company,
            'study_program' => $this->faker->optional()->word,
            'examinee_number' => $this->faker->optional()->numerify('#######'),
            'card_number' => $this->faker->optional()->numerify('#######'),
            'image' => null,
            'receive_date' => $this->faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'graduation_date' => $this->faker->dateTimeBetween('now', '+3 years')->format('Y-m-d'),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Student $student) {
            // Buat user untuk wali
            $guardianUser = User::factory()->create();
            Level::factory()->create([
                'id_user' => $guardianUser->id_user,
                'level' => 'wali',
            ]);

            // Buat guardian
            Guardian::create([
                'id_student' => $student->id_student,
                'guardian_name' => $this->faker->name,
                'id_user' => $guardianUser->id_user,
                'guardian_phone' => $this->faker->phoneNumber,
                'alt_phone' => $this->faker->optional()->phoneNumber,
                'guardian_job' => $this->faker->jobTitle,
                'guardian_address' => $this->faker->address,
            ]);
        });
    }
}
