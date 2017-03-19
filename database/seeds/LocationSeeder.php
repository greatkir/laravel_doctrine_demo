<?php

use Illuminate\Database\Seeder;
/**
 *
 *
 * @author kirill
 */
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $records = ['Chisinau', 'London', 'Paris', 'Madrid'];
        foreach ($records as $single_record) {
            DB::table('Locations')->insert([
                'name' => $single_record,
                'created_on' => new DateTime,

            ]);
        }
    }
}
