<?php

namespace App\Http\Controllers;

use App\HandlesApiExceptions;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use HandlesApiExceptions;
    public function __construct(private readonly UserService $userService)
    {
    }
    /**
     * User Registration API
     *
     * Registration of the user.
     *
     * @unauthenticated
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function register(RegisterRequest $request)
    {
        return $this->tryCatch(function () use ($request) {
            $registeredUser = $this->userService->registerUser($request->validated());

            return response()->json([
                'data' => new UserResource($registeredUser),
                'message' => "you have successfully registered",
            ], Response::HTTP_CREATED);
        });
    }

    /**
     * User Login API
     *
     * API to make user logged in using token.
     *
     * @unauthenticated
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function login(LoginRequest $request)
    {
        return $this->tryCatch(function () use ($request) {

            $loginUser = $this->userService->login($request->validated());

            if ($loginUser['status']) {
                return response()->json([
                    'data' => $loginUser['data'],
                    'message' => $loginUser['message'],
                ], Response::HTTP_CREATED);
            }

            return response()->json([
                'error' => $loginUser['message'],
            ], 422);
        });
    }

    /**
     * User Logout API
     *
     * API to make user logout.
     *
     * @unauthenticated
     *
     */
    public function logout(Request $request)
    {
        return $this->tryCatch(function () use ($request) {

            auth()->user()->tokens()->delete();
            return response()->json([
                'message' => "User logged out",
            ], Response::HTTP_CREATED);
        });
    } 
} 