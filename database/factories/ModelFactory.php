<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'birthday' => $faker->date,
        'verified' => true,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        //'remember_token' => str_random(10),
    ];
});

$factory->define(App\Listing::class, function (Faker\Generator $faker) {
    $c = App\Category::allLeaves()->pluck('id')->toArray();

    return [
        'title' => str_limit($faker->sentence, 75),
        'user_id' => 1,
        'category_id' => $c[mt_rand(0, count($c) - 1)],
        'active' => true,
    ];
});

$factory->define(App\Review::class, function ($faker) {
    return [
        'title' => str_limit($faker->sentence, 75),
    ];
});
