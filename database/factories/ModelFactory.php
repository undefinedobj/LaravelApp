<?php

use Illuminate\Support\Str;
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
        'avatar' => $faker->imageUrl(256, 256),
        'email' => $faker->unique()->safeEmail,
        'confirm_code' => Str::random(10),
        'email_verified_at' => now(),
        'password' => bcrypt(Str::random(10)),
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Models\Discussion::class, function (Faker $faker) {

    $user_ids = App\Models\User::pluck('id')->toArray();

    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => $faker->randomElement($user_ids),
        'last_user_id' => $faker->randomElement($user_ids)
    ];
});


