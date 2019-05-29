<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimalsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test*/

    public function an_user_can_create_an_owner()
    {
        $this->withoutExceptionHandling();

        $attributes = [

            'owner' => $this->faker->word,

            'animal' => $this->faker->word
        ];

        $this->post('/owners', $attributes)->assertRedirect('/owners');

        $this->assertDatabaseHas('owners', $attributes);

        $this->get('/owners')->assertSee($attributes['owner']);
    }

    /** @test*/

    public function an_user_can_view_an_owner()
    {
        $this->withoutExceptionHandling();

        $owner = factory('App\Owner')->create();

        $this->get('/owners/'.$owner->id)
        
        ->assertSee($owner->owner)

        ->assertSee($owner->animal);
    }


    /** @test*/

    public function an_owner_requires_an_owner()
    {
        $attributes = factory('App\Owner')->raw(['owner' => '']);

        $this->post('/owners', $attributes)->assertSessionHasErrors('owner');
    }

    /** @test*/

    public function an_owner_requires_an_animal()
    {
        $attributes = factory('App\Owner')->raw(['animal' => '']);

        $this->post('/owners', $attributes)->assertSessionHasErrors('animal');
    }
}
