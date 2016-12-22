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
            [ 'name' => 'Appliances', 'active' => 1, 'popular' => mt_rand(0,1) ],
            [ 'name' => 'Health & Beauty', 'active' => 1, 'popular' => mt_rand(0,1) ],
            [ 'name' => 'Electronics', 'active' => 1, 'popular' => mt_rand(0,1),
                'children' => [
                    [ 'name' => 'TVs', 'active' => 1, 'popular' => mt_rand(0,1),
                        'children' => [
                            [ 'name' => '4K TVs', 'active' => 1, 'popular' => mt_rand(0,1) ],
                            [ 'name' => 'Full HD TVs', 'active' => 1, 'popular' => mt_rand(0,1) ]
                        ]],
                    [ 'name' => 'Mobile Phones', 'active' => 1, 'popular' => mt_rand(0,1) ],
                    [ 'name' => 'Hi-Fi', 'active' => 1, 'popular' => mt_rand(0,1),
                        'children' => [
                            [ 'name' => 'Speakers', 'active' => 1, 'popular' => mt_rand(0,1) ],
                            [ 'name' => 'Portable Speakers', 'active' => 1, 'popular' => mt_rand(0,1) ],
                            [ 'name' => 'Computer Speakers', 'active' => 1, 'popular' => mt_rand(0,1) ],
                            [ 'name' => 'Docks', 'active' => 1, 'popular' => mt_rand(0,1) ]
                        ]]
                ]],
            [ 'name' => 'Cars', 'active' => 1, 'popular' => mt_rand(0,1) ],
            [ 'name' => 'Babies & Kids', 'active' => 1, 'popular' => mt_rand(0,1),
                'children' => [
                    [ 'name' => 'Prams & Strollers', 'active' => 1, 'popular' => mt_rand(0,1),
                        'children' => [
                            [ 'name' => '4 Wheelers', 'active' => 1, 'popular' => mt_rand(0,1) ],
                            [ 'name' => '3 Wheelers', 'active' => 1, 'popular' => mt_rand(0,1) ],
                            [ 'name' => 'Doubles', 'active' => 1, 'popular' => mt_rand(0,1) ],
                            [ 'name' => 'Accessories', 'active' => 1, 'popular' => mt_rand(0,1) ]
                        ]],
                    [ 'name' => 'Baby Feeding', 'active' => 1, 'popular' => mt_rand(0,1) ],
                    [ 'name' => 'Trampolines', 'active' => 1, 'popular' => mt_rand(0,1) ],
                    [ 'name' => 'Car Seats', 'active' => 1, 'popular' => mt_rand(0,1) ],
                    [ 'name' => 'Maternity Products', 'active' => 1, 'popular' => mt_rand(0,1) ],
                ]
            ],
        ];

        Category::buildTree($categories);
    }
}
