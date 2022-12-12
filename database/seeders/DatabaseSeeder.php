<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        // foreach ((range(1, 5)) as $index) {
            \App\Models\Profile::factory()->count(1)->for(
                \App\Models\Admin::factory(), 'profileable'
            )->create();
        // }

        // // foreach ((range(1, 5)) as $index) {
        //     \App\Models\Profile::factory()->count(1)->for(
        //         \App\Models\Investor::factory(), 'profileable'
        //     )->create();
        // }

        // foreach ((range(1, 5)) as $index) {
            // \App\Models\Profile::factory()->count(1)->for(
            //     \App\Models\Trader::factory(), 'profileable'
            // )->create();
        // }


    }
}
