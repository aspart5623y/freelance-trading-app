<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvestorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'firstname' => $faker->firstname(),
            'lastname' => $faker->lastname(),
            'phone' => $faker->phoneNumber(),
            'gender' => $faker->randomElement(['male', 'female']),
            'profile_img' => "",
            'date_of_birth' => $faker->date(),
            'nationality' => $faker->country(),
            'address' => $faker->address(),
            'wallet_balance' => 1000
        ];
    }
}
