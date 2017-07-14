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
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'password' => $password ?: $password = bcrypt('secret'),
    'remember_token' => str_random(10),
  ];
});

$factory->define(App\Location::class, function (Faker\Generator $faker) {
  return [
    'name' => $faker->unique()->state,
  ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
  return [
    'name' => $faker->unique()->firstName,
  ];
});

$factory->define(App\Video::class, function (Faker\Generator $faker) {
  return [
    'title' => $faker->unique()->title,
    'duration' => $faker->word,
    'bit_rate' => $faker->word,
    'path' => 'public/1500032946.dotcom_nxt392_tomnight_512x288.mp4',
    'size' => $faker->randomNumber,
    'format' => 'mp4',
    'location_id' => 0,
  ];
});



