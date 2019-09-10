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

$factory->define(App\Models\Discussion::class, function (Faker $faker) {

    $categories_id = App\Models\Category::where('parent_id', '!=', 0)->pluck('id')->toArray();

    return [
        'title'         => $faker->sentence,
        'preface'       => $faker->paragraph,
        'img'           => $faker->imageUrl(445, 190),
        'view_count'       => $faker->randomNumber(),
        'body'          => $faker->paragraph,
        'categories_id' => $faker->randomElement($categories_id),
        'user_id'       => 1,
        'last_user_id'  => 1
        // 'user_id'       => $faker->randomElement($user_ids),
        // 'last_user_id'  => $faker->randomElement($user_ids)
    ];
});

$factory->define(App\Models\Comment::class, function (Faker $faker) {

    $user_ids = App\Models\User::pluck('id')->toArray();
    $discussion_ids = App\Models\Discussion::pluck('id')->toArray();

    return [
        'body'          => $faker->paragraph,
        'user_id'       => $faker->randomElement($user_ids),
        'discussion_id' => $faker->randomElement($discussion_ids)
    ];
});

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'avatar'            => $faker->imageUrl(256, 256),
        'email'             => $faker->unique()->safeEmail,
        'confirm_code'      => Str::random(10),
        'email_verified_at' => now(),
        'password'          => bcrypt(Str::random(10)),
        'remember_token'    => Str::random(10),
    ];
});
