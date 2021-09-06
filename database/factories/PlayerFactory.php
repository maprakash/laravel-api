<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Player;
use App\Team;
use Faker\Generator as Faker;

$factory->define(Player::class, function (Faker $faker) {
    $filePath = 'images/players';
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'playerImageURI' => $faker->image($filePath,400,300),
        'teamId' =>Team::all()->random()->id
    ];
});
