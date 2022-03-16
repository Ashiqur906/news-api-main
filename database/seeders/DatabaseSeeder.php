<?php

namespace Database\Seeders;

use App\Models\Layout;

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
        $this->call(UserSeeder::class);
        $this->call(WidgetSeeder::class);
        $this->call(LayoutSeeder::class);
        $this->call(DistrictSeeder::class);


        // \App\Models\User::factory(10)->create();
    }
}
