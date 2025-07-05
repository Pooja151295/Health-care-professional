<?php

namespace App\Http\Controllers;

use App\HandlesApiExceptions;
use App\Http\Requests\BookAppointmentRequest;
use App\Http\Requests\UpdateAppointmentStatusRequest;
use App\Http\Resources\AppointmentResource;
use App\Services\AppointmentService;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends Controller
{
    use HandlesApiExceptions;
    public function __construct(private readonly AppointmentService $appointmentService)
    {
    }
    /**
     * List all healthcare professionals.
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(BookAppointmentRequest $request)
    {
        return $this->tryCatch(function () use ($request) {
            $result = $this->appointmentService->bookAppointment(
                $request->validated(),
                auth()->id()
            );
        
            if (is_string($result)) {
                return response()->json([
                    'message' => $result,
                ], Response::HTTP_CONFLICT);
            }
        
            return response()->json([
                'message' => 'Appointment booked successfully!',
                'data' => new AppointmentResource($result),
            ], Response::HTTP_CREATED);
        });
    }
    /**
     * getUserAppointments
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getUserAppointments()
    {
        return $this->tryCatch(function () {
            $appointments = $this->appointmentService->getUserAppointments(auth()->id());

            return response()->json([
                'message' => 'Appointments retrieved successfully',
                'data' => AppointmentResource::collection($appointments),
            ], Response::HTTP_OK);
        });
    }
    /**
     * update the appointment status in cancle and complete
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateAppointmentStatus(UpdateAppointmentStatusRequest $request)
    {
        return $this->tryCatch(function () use ($request) {
            $result = $this->appointmentService->updateAppointmentStatus(auth()->id(), $request->validated());

            if (is_string($result)) {
                return response()->json(['message' => $result], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'message' => $result['message'],
                'data' => new AppointmentResource($result['appointment']),
            ], Response::HTTP_OK);
        });
    }
}
