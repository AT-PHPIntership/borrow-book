<?php

use Faker\Generator as Faker;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Models\Book::class, function (Faker $faker) {
    $languages = ['English', 'VietNamese'];
    return [
        'category_id' => App\Models\Category::all()->random()->id,
        'title' => $faker->name,
        'description' => $faker->text,
        'number_of_page' => $faker->numberBetween(1, 10000),
        'author' => $faker->name,
        'publishing_year' => $faker->dateTime(),
        'language' => $faker->randomElement($languages),
        'quantity' => $faker->numberBetween(6, 20),
        'barcode' => $faker->isbn13()
    ];
});

$factory->define(App\Models\ImageBook::class, function (Faker $faker) {
    return [
        'book_id' => App\Models\Book::all()->random()->id,
        'image' => $faker->image(config('image.images_url'), 300, 200, null, false)
    ];
});

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'book_id' => App\Models\Book::all()->random()->id,
        'post_type' => $faker->randomElement([\App\Models\Post::COMMENT, \App\Models\Post::REVIEW]),
        'body' => $faker->text,
        'rate_point' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
        'status' => $faker->randomElement([\App\Models\Post::ACCEPT, \App\Models\Post::UNACCEPT]),
    ];
});

$factory->define(App\Models\Favorite::class, function (Faker $faker) {
    return [
        'book_id' => App\Models\Book::all()->random()->id,
        'user_id' => App\Models\User::all()->random()->id,
    ];
});

$factory->define(App\Models\Rating::class, function (Faker $faker) {
    return [
        'book_id' => App\Models\Book::all()->random()->id,
        'user_id' => App\Models\User::all()->random()->id,
        'rate' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
    ];
});

$factory->define(App\Models\Borrow::class, function (Faker $faker) {
    $startingDate = $faker->dateTimeBetween('-2 months', '+6 days');
    $endingDate   = $faker->dateTimeBetween('-1 weeks', 'now');
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'status' => $faker->randomElement([\App\Models\Borrow::BORROWING, \App\Models\Borrow::GIVE_BACK, \App\Models\Borrow::WAITTING, App\Models\Borrow::CANCEL]),
        'from_date' => $startingDate,
        'to_date' => $endingDate
    ];
});

$factory->define(App\Models\BorrowDetail::class, function (Faker $faker) {
    return [
        'book_id' => App\Models\Book::all()->unique()->random()->id,
        'quantity' => $faker->numberBetween(1, 5)
    ];
});

$factory->define(App\Models\Note::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::all()->unique()->random()->id,
        'borrow_id' => App\Models\Borrow::all()->unique()->random()->id,
        'content' => $faker->text,
    ];
});
