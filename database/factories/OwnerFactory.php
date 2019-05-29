<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Owner;
use Faker\Generator as Faker;

$factory->define(Owner::class, function (Faker $faker) {
    return [
        
    	'owner' => $faker->word,

    	'animal' => $faker->word
    ];
});
