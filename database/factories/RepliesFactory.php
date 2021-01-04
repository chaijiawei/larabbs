<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    $updatedAt = $faker->dateTimeThisMonth();
    return [
        'content' => $faker->sentence,
        'user_id' => $faker->randomElement(range(1, 10)),
        'topic_id' => $faker->randomElement(range(1, 10)),
        'created_at' => $faker->dateTimeThisMonth($updatedAt),
        'updated_at' => $updatedAt,
    ];
});
