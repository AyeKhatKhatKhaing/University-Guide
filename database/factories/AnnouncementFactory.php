<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Announcement;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        "title"=>$faker->text,
        "description"=>$faker->text(200)
    ];
});
