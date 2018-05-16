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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => 'default-user.png',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'identity_number' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'dob' => $faker->date(),
        'address' => $faker->address,
        'role' => $faker->randomElement([\App\Models\User::ROLE_USER, \App\Models\User::ROLE_ADMIN]),
        'remember_token' => str_random(10),
    ];
});
