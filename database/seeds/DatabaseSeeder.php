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
        $this->call(CategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(ListingsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
    }
}
