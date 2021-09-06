<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    $filePath = 'images/teams';
    return [
        'name' =>$faker->name,
        'logoURI' => $faker->image($filePath,400,300)
    ];
});
