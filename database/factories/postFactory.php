<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->randomElement(User::all()->pluck('id')->toArray()),
        'caption'=>$faker->text(100),
        'image'=>$faker->imageUrl(600,600),

    ];
});
