<?php

namespace Tests\Feature;

use App\Models\HealthcareProfessional;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;
// use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AppointmentTest extends TestingTestCase
{
    use RefreshDatabase;
    // public function test_user_can_book_appointment()
    // {
    //     Sanctum::actingAs(User::factory()->create());
    //     $professional = HealthcareProfessional::factory()->create();

    //     $response = $this->postJson('/api/book-appointment', [
    //         'healthcare_professional_id' => $professional->id,
    //         'appointment_start_time' => now()->addDays(2),
    //         'appointment_end_time' => now()->addDays(2)->addHour(),
    //     ]);
    //     $response->assertStatus(201)
    //              ->assertJsonStructure(['message', 'data']);
    // }
    // public function test_user_can_view_their_appointments()
    // {
    //     $user = User::factory()->create();
    //     Sanctum::actingAs($user);

    //     $professional = HealthcareProfessional::factory()->create();

    //     Appointment::factory()->create([
    //         'user_id' => $user->id,
    //         'healthcare_professional_id' => $professional->id,
    //     ]);

    //     $response = $this->getJson('/api/get-all-appointments');

    //     $response->assertStatus(200)
    //              ->assertJsonStructure(['message', 'data']);
    // }
    // public function test_user_can_cancel_appointment_if_more_than_24_hours_left()
    // {
    //     $user = User::factory()->create();
    //     Sanctum::actingAs($user);

    //     $appointment = Appointment::factory()->create([
    //         'user_id' => $user->id,
    //         'appointment_start_time' => now()->addDays(2),
    //         'appointment_end_time' => now()->addDays(2)->addHour(),
    //     ]);

    //     $response = $this->patchJson('/api/appointments/status', [
    //         'appointment_id' => $appointment->id,
    //         'status' => 'cancelled',
    //     ]);

    //     $response->assertStatus(200)
    //              ->assertJsonFragment(['message' => 'Appointment cancelled successfully.']);
    // }
    // public function test_user_cannot_cancel_appointment_within_24_hours()
    // {
    //     $user = User::factory()->create();
    //     Sanctum::actingAs($user);

    //     $appointment = Appointment::factory()->create([
    //         'user_id' => $user->id,
    //         'appointment_start_time' => now()->addHours(10),
    //         'appointment_end_time' => now()->addHours(11),
    //     ]);

    //     $response = $this->patchJson('/api/appointments/status', [
    //         'appointment_id' => $appointment->id,
    //         'status' => 'cancelled',
    //     ]);

    //     $response->assertStatus(400)
    //              ->assertJsonFragment(['message' => 'Cannot cancel within 24 hours of the appointment.']);
    // }
    // public function test_user_can_mark_appointment_as_completed()
    // {
    //     $user = User::factory()->create();
    //     Sanctum::actingAs($user);

    //     $appointment = Appointment::factory()->create([
    //         'user_id' => $user->id,
    //         'appointment_start_time' => now()->subDays(2),
    //         'appointment_end_time' => now()->subDay(),
    //     ]);

    //     $response = $this->patchJson('/api/appointments/status', [
    //         'appointment_id' => $appointment->id,
    //         'status' => 'completed',
    //     ]);

    //     $response->assertStatus(200)
    //              ->assertJsonFragment(['message' => 'Appointment marked as completed.']);
    // }
    // public function test_user_cannot_mark_appointment_as_completed_before_it_ends()
    // {
    //     $user = User::factory()->create();
    //     Sanctum::actingAs($user);

    //     $appointment = Appointment::factory()->create([
    //         'user_id' => $user->id,
    //         'appointment_start_time' => now()->addHours(1),
    //         'appointment_end_time' => now()->addHours(2),
    //     ]);

    //     $response = $this->patchJson('/api/appointments/status', [
    //         'appointment_id' => $appointment->id,
    //         'status' => 'completed',
    //     ]);

    //     $response->assertStatus(400)
    //              ->assertJsonFragment(['message' => 'Cannot mark as completed before the appointment end time.']);
    // }
}
