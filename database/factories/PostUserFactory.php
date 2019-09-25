<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\PostUser::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->randomElement(\App\User::all()->pluck('id')->toArray()),
        'post_id'=>$faker->randomElement(\App\Post::all()->pluck('id')->toArray()),

    ];
});
