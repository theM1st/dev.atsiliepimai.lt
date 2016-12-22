<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Attribute::class, 10)
            ->create()->each(function ($item) {
                for ($i = 0; $i < rand(1, 10); ++$i) {
                    $item->options()->save(
                        factory(App\AttributeOption::class)->make()
                    );
                }
            });

        $attribute = App\Attribute::create([
            'name' => 'Modeliai',
            'title' => 'Modeliai',
            'main' => 1
        ]);

        $attribute->options()->saveMany([
            new App\AttributeOption(['option_name' => '16GB']),
            new App\AttributeOption(['option_name' => '32GB']),
            new App\AttributeOption(['option_name' => '64GB'])
        ]);
    }
}