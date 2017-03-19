<?php

use Illuminate\Database\Seeder;
/**
 *
 *
 * @author kirill
 */
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = ['Google', 'Facebook', 'Badoo', 'Apple'];
        foreach ($records as $single_record) {
            DB::table('Brands')->insert([
                'name' => $single_record,
                'created_on' => new DateTime,

            ]);
        }
    }
}
