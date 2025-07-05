<?php

namespace Database\Seeders;

use Database\Factories\HealthcareProfessionalFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HealthcareProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HealthcareProfessionalFactory::new()->count(10)->create();
    }
}
