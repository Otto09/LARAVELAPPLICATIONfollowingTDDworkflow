<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Owner;
use App\Specific;
use Faker\Generator as Faker;

$factory->define(Specific::class, function (Faker $faker) {
    
    return [

        'body' => $faker->sentence,

        'owner_id' => factory(Owner::class),

        /*'owner_id' => function ()
        {
        	return factory(Owner::class)->create()->id;
        }*/

        'specified' => false
    ];
});
