<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $gender = ['male','female'];
        $status = ['Weight gain','Weight loss','Body beauty','Yoga','Zomba','Aerobics'];

        return [
            'name' => fake()->name(),
            'dob' => strval(fake()->date),
            'phone' => fake()->phoneNumber(),
            'gender' => $gender[fake()->numberBetween(0,1)],
            'address' => fake()->address(),
            'status' => $status[fake()->numberBetween(0,4)],
            'branch_id' => fake()->numberBetween(1,10),
        ];
    }
}
