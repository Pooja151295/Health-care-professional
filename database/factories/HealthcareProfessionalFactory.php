<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HealthcareProfessional>
 */
class HealthcareProfessionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specialities = [
            'Cardiology',
            'Pediatrics',
            'Orthopedics',
            'Dermatology',
            'Psychiatry',
            'Radiology',
            'Oncology',
            'Neurology',
            'Emergency Medicine',
            'Family Medicine',
        ];
    
        return [
            'name' => $this->faker->name(),
            'speciality' => $this->faker->randomElement($specialities),
        ];
    }
}
