<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
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
            'level' => 'admin',
            // 'level' => $faker->randomElement(['manager', 'support']),
        ];
    }
}
