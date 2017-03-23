<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocationSeeder::class);
        $this->command->info('Locations table seeded!');
        $this->call(BrandSeeder::class);
        $this->command->info('Brands table seeded!');
        $this->call(JobSeeder::class);
        $this->command->info('Jobs table seeded!');
    }

}
