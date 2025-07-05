<?php

namespace Database\Factories;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'healthcare_professional_id' => \App\Models\HealthcareProfessional::factory(),
            'appointment_start_time' => now()->addDays(2),
            'appointment_end_time' => now()->addDays(2)->addHour(),
            'status' => fake()->randomElement(AppointmentStatus::values()),
        ];
    }
}
