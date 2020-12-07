<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    $updatedAt = $faker->dateTimeThisMonth();
    return [
        'title' => $faker->sentence,
        'body' => $faker->text,
        'excerpt' => $faker->sentence,
        'category_id' => $faker->randomElement(range(1, 4)),
        'user_id' => $faker->randomElement(range(1, 10)),
        'created_at' => $faker->dateTimeThisMonth($updatedAt),
        'updated_at' => $updatedAt,
    ];
});
