<?php

use Illuminate\Database\Seeder;

class ListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Listing::class, 50)
            ->create()->each(function ($l) {
                $l->reviews()->save(factory(App\Review::class)->create([
                    'user_id' => 1,
                    'listing_id' => $l->id
                ]));
            });
    }
}
