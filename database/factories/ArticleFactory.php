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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Article::class, function (Faker $faker) {
    $arr = [
        $faker->phoneNumber,
        $faker->colorName,
        $faker->address,
        $faker->company,
        $faker->internetExplorer,

        // 下面这 4 个不能使用, 会报错.
        // $faker->DataTime,
        // $faker->Internet,
        // $faker->Person,
        // $faker->Payment,
    ];
    $content = implode(' ', $arr);

    return [
        'title' => $faker->sentence,
        'content' => $content,
        'status' => $faker->boolean(),
    ];
});
