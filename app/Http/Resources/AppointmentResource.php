<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'healthcare_professional' => [
                'id' => $this->healthcareProfessional?->id,
                'name' => $this->healthcareProfessional?->name,
            ],
            'appointment_start_time' => $this->appointment_start_time
            ? $this->appointment_start_time->format('d M Y, h:i A')
            : null,
            'appointment_end_time' => $this->appointment_end_time
            ? $this->appointment_end_time->format('d M Y, h:i A')
            : null,
            'status' => $this->status,
        ];
    }
}
