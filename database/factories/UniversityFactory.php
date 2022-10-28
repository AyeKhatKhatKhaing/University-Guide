<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\University;
use Faker\Generator as Faker;

$factory->define(University::class, function (Faker $faker) {
    return [
        "name"=>$faker->name(),
        "location"=>$faker->city(),
        "description"=>$faker->text(1000),
        "mark_one"=>rand(240,530),
        "mark_two"=>rand(240,530),
    ];
});
