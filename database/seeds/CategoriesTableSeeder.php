<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'name' => 'Appliances' ],
            [ 'name' => 'Health & Beauty' ],
            [ 'name' => 'Electronics', 'children' => [
                [ 'name' => 'TVs', 'children' => [
                    [ 'name' => '4K TVs' ],
                    [ 'name' => 'Full HD TVs' ]
                ]],
                [ 'name' => 'Mobile Phones' ],
                [ 'name' => 'Hi-Fi', 'children' => [
                    [ 'name' => 'Speakers' ],
                    [ 'name' => 'Portable Speakers' ],
                    [ 'name' => 'Computer Speakers' ],
                    [ 'name' => 'Docks' ]
                ]]
            ]],
            [ 'name' => 'Cars' ]
        ];

        Category::buildTree($categories);
    }
}
