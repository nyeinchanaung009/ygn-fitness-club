<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['name' => '1 month','price' => 42000,'period' => 1,'type' => 'Month'],
            ['name' => '2 months','price' => 84000,'period' => 2,'type' => 'Month'],
            ['name' => '3 months','price' => 126000,'period' => 3,'type' => 'Month'],
            ['name' => '4 months','price' => 168000,'period' => 4,'type' => 'Month'],
            ['name' => '6 months','price' => 252000,'period' => 6,'type' => 'Month'],
            ['name' => '1 year','price' => 504000,'period' => 1,'type' => 'Year']
        ];     

        foreach($plans as $plan){
            Plan::create([
                'name' => $plan['name'],
                'price' => $plan['price'],
                'period' => $plan['period'],
                'type' => $plan['type'],
            ]);  
        }
    }
}
