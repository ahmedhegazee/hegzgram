<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ProfileUser::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->randomElement(\App\User::all()->pluck('id')->toArray()),
        'profile_id'=>$faker->randomElement(\App\Profile::all()->pluck('id')->toArray()),
    ];
});
