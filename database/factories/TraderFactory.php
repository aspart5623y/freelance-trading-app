<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TraderFactory extends Factory
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
            'profile_img' => "", 
            'phone' => $faker->phoneNumber(),
            'gender' => $faker->randomElement(['male', 'female']),
            'nationality' => $faker->country(), 
            'percentage' => $faker->numberBetween(0, 100), 
            'date_of_birth' => $faker->date(),
            'expertise' => $faker->paragraph(), 
            'show_admin_rating' => $faker->randomElement([true, false]), 
            'admin_rating' => 3, 
            'liquidity' => null, 
            'liquidity_amt' => null, 
            'wallet_balance' => 1000
        ]; 
    } 
}
