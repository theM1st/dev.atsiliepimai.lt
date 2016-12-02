<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [ 'name' => 'Lietuva' ],
            [ 'name' => 'Latvija' ],
            [ 'name' => 'Estonija' ],
        ];

        foreach ($countries as $k =>$c) {
            App\Country::create([
                'name' => $c['name'],
                'position' => $k,
            ]);
        }
    }
}
