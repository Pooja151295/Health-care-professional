<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\HealthcareProfessional;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HealthcareProfessionalService 
{
    public function __construct()
    {
    }
    public function index(){
        $professionals = HealthcareProfessional::all();

        return $professionals;
    }
}
