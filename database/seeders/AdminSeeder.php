<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i <= 5; $i++){
            User::create([
                'name' => 'Admin'.$i,
                'email' => 'admin'.$i.'@gmail.com',
                'phone' => '09'.strval(rand(000000000,999999999)),
                'image' => null,
                'password' => Hash::make('admin'.$i),
                'branch_id' => $i
            ]);
        }
    }
}
