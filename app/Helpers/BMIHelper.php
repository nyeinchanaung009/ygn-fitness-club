<?php

namespace App\Helpers;

class BMIHelper
{
    public static function calculateBMI($weightInPounds, $heightInInches)
    {
        // Convert weight to kilograms
        $weightInKg = $weightInPounds * 0.453592;

        // Convert height to meters
        $heightInMeters = $heightInInches * 0.0254;

        // Calculate BMI
        $bmi = $weightInKg / ($heightInMeters * $heightInMeters);

        // return $bmi;
        $status = '';

        if ($bmi < 18.5) {
            $status = 'Underweight';
        }elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $status = 'Normal weight';
        }elseif ($bmi >= 25 && $bmi <= 29.9) {
            $status = 'Overweight';
        }elseif ($bmi >= 30) {
            $status = 'Obesity';
        }

        return [
            'number' => number_format($bmi, 2),
            'status' => $status,
        ];
    
    }
}

?>