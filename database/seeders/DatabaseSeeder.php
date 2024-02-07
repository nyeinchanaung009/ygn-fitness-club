<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([BranchSeeder::class,AdminSeeder::class,PlanSeeder::class]);
        Member::factory(100)->create();
        $this->call([MembershipSeeder::class,fitnessDataSeeder::class]);
    }
}
