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
        'category_id' => $c[mt_rand(0, count($c) - 1)],
        'active' => true,
    ];
});

$factory->define(App\Review::class, function ($faker) {
    $users = App\User::all()->pluck('id')->toArray();
    $listings = App\Listing::all()->pluck('id')->toArray();

    return [
        'review_title' => str_limit($faker->sentence, 75),
        'review_description' => $faker->paragraph,
        'rating' => rand(1, 5),
        'listing_id' => $listings[mt_rand(0, count($listings) - 1)],
        'user_id' => $users[mt_rand(0, count($users) - 1)],
    ];
});


$factory->define(App\Attribute::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'title' => $faker->word,
        'main' => rand(0, 1),
    ];
});

$factory->define(App\AttributeOption::class, function (Faker\Generator $faker) {
    return [
        'option_name' => $faker->word,
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'content' => $faker->paragraph,
        'active' => true,
    ];
});

$factory->define(App\MailSubject::class, function (Faker\Generator $faker) {
    return [
        'subject' => str_limit($faker->sentence, 25),
    ];
});

$factory->define(App\MailMessage::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->paragraph,
        'sender_id' => 1,
        'receiver_id' => 2
    ];
});