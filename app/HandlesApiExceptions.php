<?php

namespace App;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HandlesApiExceptions
{
    /**
     * Wrap any callback in try/catch and return JSON.
     */
    public function tryCatch(callable $callback): JsonResponse
    {
        try {
            return $callback();
        } catch (\Throwable $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
                'trace' => config('app.debug') ? $exception->getTrace() : [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
