<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Unit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil ID unit yang ada secara acak
        $unitIds = Unit::pluck('id')->toArray();

        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'unit_id' => fake()->randomElement($unitIds), // <-- Pilih ID unit secara acak
            'position' => fake()->jobTitle(),
            'status' => 'active',
        ];
    }
}
