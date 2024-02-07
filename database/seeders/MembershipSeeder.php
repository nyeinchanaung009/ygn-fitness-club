<?php

namespace Database\Seeders;

use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a = rand(0,1);
        for($i = 1; $i <= 100; $i++){
            if($a == 0){
                Membership::create([
                    'member_id' => $i,
                    'plan_id' => rand(1,6),
                    'plan_start_date' => Carbon::now(),
                    'plan_expire_date' => Carbon::today()->subDays(rand(0, 365))
                ]);  
                $a = rand(0,1);
            }else{
                Membership::create([
                    'member_id' => $i,
                    'plan_id' => rand(1,6),
                    'plan_start_date' => Carbon::now(),
                    'plan_expire_date' => Carbon::today()->addDays(rand(1, 200))
                ]); 
                $a = rand(0,1);
            }
            
        }
    }
}
