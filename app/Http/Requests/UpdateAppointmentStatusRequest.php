<?php

namespace App\Http\Requests;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAppointmentStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'appointment_id' => 'required|integer|exists:appointments,id',
            'status' => ['required',Rule::in(AppointmentStatus::values())],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $appointmentId = $this->input('appointment_id');
            $status = $this->input('status');
            if ($appointmentId) {
                $appointment = Appointment::where('id', $appointmentId)
                    ->where('user_id' , auth()->id())
                    ->where('status' ,AppointmentStatus::Booked->value)
                    ->first();
                if (! $appointment) {
                    $action = '';

                    if ($status === AppointmentStatus::Cancelled->value) {
                        $action = 'cancel';
                    } elseif ($status === AppointmentStatus::Completed->value) {
                        $action = 'complete';
                    } else {
                        $action = 'update';
                    }

                    $validator->errors()->add(
                        'appointment_id',
                        "You do not have permission to {$action} this appointment.This appointment is already completed or cancelled."
                    );
                }
            } 
        });
    }
}
