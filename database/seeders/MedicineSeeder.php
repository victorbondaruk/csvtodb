<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicine::factory()->create([
            'name' => 'BCG vaccine',
            'section' => 'Recommendations for all immunization programmes',
            'indication' => 'Need for immunization against tuberculosis',
        ]);
    }
}