<?php

namespace Tests\Feature;

use App\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\OwnerFactory;
use Tests\TestCase;

class ManageAnimalsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */

    public function guests_cannot_manage_owners()
    {
        //$this->withoutExceptionHandling();

        $owner = factory('App\Owner')->create();
      

        $this->get('/owners')->assertRedirect('login');

        $this->get('/owners/create')->assertRedirect('login');

        $this->get($owner->path() .'/edit')->assertRedirect('login');

        $this->get($owner->path())->assertRedirect('login');

        $this->post('/owners', $owner->toArray())->assertRedirect('login');
    }

    /** @test */

    public function an_user_can_create_an_owner()
    {
        // $this->withoutExceptionHandling();

        $this->signIn();

        // $this->actingAs(factory('App\User')->create());

        $this->get('/owners/create')->assertStatus(200);

        /*$attributes = [

            'owner' => $this->faker->word,

            'animal' => $this->faker->word,

            'remarks' => 'General remarks here'
        ];*/

        $this->followingRedirects()

            ->post('/owners', $attributes = factory(Owner::class)->raw())

                /*$owner = Owner::where($attributes)->first();

                $response->assertRedirect($owner->path());

                $this->get($owner->path())*/

            ->assertSee($attributes['owner'])

            ->assertSee($attributes['animal'])

            ->assertSee($attributes['remarks']);
    }

    /** @test */

    function specifics_can_be_part_of_owner_creation()
    {
        $this->signIn();

        $attributes = factory(Owner::class)->raw();

        $attributes['specifics'] = [

            ['body' => 'Specific 1'],

            ['body' => 'Specific 2']

        ];

        $this->post('/owners', $attributes);

        $this->assertCount(2, Owner::first()->specifics);
    }     

    /** @test */

    public function an_user_can_see_owners_they_have_invited_to_on_their_dashboard()
    {
        // Given we're signed in

        /*$user = $this->signIn();*/

        // and we've been invited to an owner that was not created by us,

        $owner = tap(OwnerFactory::create())->invite($this->signIn());

        /*$owner = OwnerFactory::create();

        $owner->invite($user);*/

        // when I visit my dashboard,

        // I should see that owner.

        $this->get('/owners')

            ->assertSee($owner->owner);
    }

    /** @test */

    public function unauthorized_users_cannot_delete_owners()
    {
        // $this->withoutExceptionHandling();

        $owner = OwnerFactory::create();

        $this->delete($owner->path())

            ->assertRedirect('/login');

        $user = $this->signIn();

        $this->delete($owner->path())->assertStatus(403);

        $owner->invite($user);

        $this->actingAs($user)->delete($owner->path())->assertStatus(403);
    }

    /** @test */

    public function an_user_can_delete_an_owner()
    {
        // $this->withoutExceptionHandling();

        $owner = OwnerFactory::create();

        $this->actingAs($owner->user)

            ->delete($owner->path())

            ->assertRedirect('/owners');

        $this->assertDatabaseMissing('owners', $owner->only('id'));
    }

    /** @test */

    public function an_user_can_update_an_owner()
    {
        // $this->withoutExceptionHandling();

       /*$this->signIn();

       //$this->be(factory('App\User')->create());

        $this->withoutExceptionHandling();

        $owner = factory('App\Owner')->create(['user_id' => auth()->id()]);*/

        $owner = OwnerFactory::create();

        $this->actingAs($owner->user)

            ->patch($owner->path(), $attributes = 
            [
                'owner' => 'Changed',

                'animal' => 'Changed',

                'remarks' => 'Changed'
            ])
            ->assertRedirect($owner->path());

        $this->get($owner->path().'/edit')->assertOk();//assertStatus(200);

        $this->assertDatabaseHas('owners', $attributes);
    }

    /** @test */

    public function an_user_can_update_an_owners_remarks()
    {
        $owner = OwnerFactory::create();

        $this->actingAs($owner->user)

            ->patch($owner->path(), $attributes = 
            [
                'remarks' => 'Changed'
            ]);

        $this->assertDatabaseHas('owners', $attributes);

        // $this->get($owner->path().'/edit')->assertRedirect('login');
    }

    /** @test */

    public function an_user_can_view_his_owner()
    {
        /*$this->signIn();

        //$this->be(factory('App\User')->create());

        $this->withoutExceptionHandling();

        $owner = factory('App\Owner')->create(['user_id' => auth()->id()]);*/

        $owner = OwnerFactory::create();

        $this->actingAs($owner->user)

            ->get($owner->path())

            ->assertSee($owner->owner)

            ->assertSee($owner->animal);
    }

        /** @test */

    public function an_authenticated_user_cannot_view_the_owners_of_others() 
    {
        $this->signIn();

        //$this->be(factory('App\User')->create());

        //$this->withoutExceptionHandling();

        $owner = factory('App\Owner')->create();

        $this->get($owner->path())->assertStatus(403);        
    }

        /** @test */

    public function an_authenticated_user_cannot_update_the_owners_of_others() 
    {
        $this->signIn();

        //$this->be(factory('App\User')->create());

        //$this->withoutExceptionHandling();

        $owner = factory('App\Owner')->create();

        $this->patch($owner->path())->assertStatus(403);        
    }

    /** @test */

    public function an_owner_requires_an_owner()
    {
        $this->signIn();

        //$this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Owner')->raw(['owner' => '']);

        $this->post('/owners', $attributes)->assertSessionHasErrors('owner');
    }

    /** @test */

    public function an_owner_requires_an_animal()
    {
        $this->signIn();
        
        //$this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Owner')->raw(['animal' => '']);

        $this->post('/owners', $attributes)->assertSessionHasErrors('animal');
    }
}
