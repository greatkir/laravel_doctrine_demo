<?php

use Illuminate\Database\Seeder;
/**
 * 
 *
 * @author kirill
 */
class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $records = ['Ninja', 'Superstar', 'RockStar', 'Superman', 'Batman',
            'Joker', 'SmallNoob', 'DeveloperOfUniverse', 'DJ', 'Dodoo',
            'Blabla', 'SomethingElse', 'StarStar', 'Geenius', 'Diamond',
            'Noob', 'C++ developer', 'PHP developer', 'DGG', 'Systems Eng'];
        $locations = ['Chisinau', 'London', 'Paris', 'Madrid'];
        $brands = ['Google', 'Facebook', 'Badoo', 'Apple'];
        foreach ($records as $record_single) {
            $location_current = $locations[rand(0, 3)];
            $brand_current = $brands[rand(0, 3)];
            $location_record = DB::table('Locations')
                            ->where('name', '=', $location_current)
                            ->select('id')->first();
            $brand_record = DB::table('Brands')
                            ->where('name', '=', $brand_current)
                            ->select('id')->first();
            DB::table('Jobs')->insert([
                'name' => $record_single,
                'contact_email' => str_random(10).'@gmail.com',
                'description' => str_random(300),
                'created_on' => new DateTime(),
                'location_id' => $location_record->id,
                'brand_id' => $brand_record->id,
            ]);
        }
    }
}
