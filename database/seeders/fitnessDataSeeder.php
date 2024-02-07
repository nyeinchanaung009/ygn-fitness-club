<?php

namespace Database\Seeders;

use App\Models\MonthlyFitnessData;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class fitnessDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = ['Underweight','Normal weight','Overweight','Obesity'];

        for($i=1; $i <= 100; $i++){
            MonthlyFitnessData::create([
                'member_id' => $i,
                'weight' => rand(85,200),
                'height' => rand(56,72),
                'bmi_no' => rand(16,40),
                'bmi_status' => $status[rand(0,3)],
                'chest_size' => rand(17,35),
                'shoulder_size' => rand(17,40),
                'waist_size' => rand(17,40),
                'hip_size' => rand(20,50),
                'date' => Carbon::today()->subDays(rand(0, 365))
            ]);
        }
    }
}
