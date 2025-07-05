<?php

namespace App\Http\Controllers;

use App\HandlesApiExceptions;
use App\Http\Resources\HealthcareProfessionalResource;
use App\Services\HealthcareProfessionalService;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class HealthcareProfessionalController extends Controller
{
    use HandlesApiExceptions;
    public function __construct(private readonly HealthcareProfessionalService $healthcareProfessionalService)
    {
    }
    /**
     * List all healthcare professionals.
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->tryCatch(function () {
            $professionals = $this->healthcareProfessionalService->index();
            return response()->json([
                'data' => HealthcareProfessionalResource::collection($professionals),
                'message' => "Healthcare professionals list shown successfully",
            ], Response::HTTP_CREATED);
        });
    }
}
