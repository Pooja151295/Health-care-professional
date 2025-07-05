<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function responseJson(mixed $data = null, int $status = 200, string $message = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function abortJsonResponse($error, int $status = 422): JsonResponse
    {
        return response()->json([
            'error' => $error instanceof \Exception ? $error->getMessage() : $error,
        ], $status);
    }
}
