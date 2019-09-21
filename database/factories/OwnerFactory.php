<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Owner;
use Faker\Generator as Faker;

$factory->define(Owner::class, function (Faker $faker) {

    return [
        
    	'owner' => $faker->word,

    	'animal' => $faker->word,

    	'remarks' => 'Foobar remarks',

    	/*'user_id' =>  function ()
    	{
    		return factory(App\User::class)->create()->id;
    	}*/

    	'user_id' => factory(App\User::class)
    ];
});
