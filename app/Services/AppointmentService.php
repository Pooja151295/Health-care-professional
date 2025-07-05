<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Http\Resources\UserResource;
use App\Models\Appointment;
use App\Models\HealthcareProfessional;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AppointmentService 
{
    public function __construct()
    {
    }
    public function bookAppointment(array $data, int $userId): Appointment|string{
        $overlapping = Appointment::where('healthcare_professional_id', $data['healthcare_professional_id'])
            ->whereNull('deleted_at')
            ->where('status', 'Booked')
            ->where(function ($query) use ($data) {
                $query->whereBetween('appointment_start_time', [
                        $data['appointment_start_time'],
                        $data['appointment_end_time']
                    ])
                    ->orWhereBetween('appointment_end_time', [
                        $data['appointment_start_time'],
                        $data['appointment_end_time']
                    ])
                    ->orWhere(function ($query) use ($data) {
                        $query->where('appointment_start_time', '<=', $data['appointment_start_time'])
                              ->where('appointment_end_time', '>=', $data['appointment_end_time']);
                    });
            })
            ->exists();

        if ($overlapping) {
            return 'This time slot is not available. Please choose a different time.';
        }

        return Appointment::create([
            'user_id' => $userId,
            'healthcare_professional_id' => $data['healthcare_professional_id'],
            'appointment_start_time' => $data['appointment_start_time'],
            'appointment_end_time' => $data['appointment_end_time'],
            'status' => 'Booked',
        ]);
    }
    public function getUserAppointments(int $userId)
    {
        return Appointment::where('user_id', $userId)
            ->with('healthcareProfessional')
            ->latest()
            ->get();
    }
    public function updateAppointmentStatus(int $userId, array $data)  {
        $appointment = Appointment::where('id', $data['appointment_id'])
        ->where('user_id', $userId)
        ->first();

        $newStatus = $data['status'];
        
        if ($newStatus === AppointmentStatus::Cancelled->value) {
            $hoursUntilStart = now()->diffInHours($appointment->appointment_start_time);
            Log::info('Hours until appointment start:', [$hoursUntilStart]);
        
            if ($hoursUntilStart < 24) {
                return 'Cannot cancel within 24 hours of the appointment.';
            }
        }
        
        if ($newStatus === AppointmentStatus::Completed->value) {
            Log::info('Now:', [now()]);
            Log::info('Appointment ends at:', [$appointment->appointment_end_time]);
        
            if (now()->lt($appointment->appointment_end_time)) {
                return 'Cannot mark as completed before the appointment end time.';
            }
        }
        $appointment->status = $newStatus;
        $appointment->save();
        $message = match ($newStatus) {
            AppointmentStatus::Completed->value => 'Appointment marked as completed.',
            AppointmentStatus::Cancelled->value => 'Appointment cancelled successfully.',
            default => 'Appointment status updated.',
        };
    
        return [
            'appointment' => $appointment,
            'message' => $message,
        ];
    }
}
