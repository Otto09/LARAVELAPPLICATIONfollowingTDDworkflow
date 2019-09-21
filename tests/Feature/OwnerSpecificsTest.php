<?php

namespace Feature;

use App\Owner;
use App\Specific;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\OwnerFactory;
use Tests\Setup;
use Tests\TestCase;

class OwnerSpecificsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function guests_cannot_add_specifics_to_owners()
    {
        $owner = factory('App\Owner')->create();

        $this->post($owner->path() . '/specifics')->assertRedirect('login');
    }

        /** @test */

    public function only_the_user_of_an_owner_may_add_specifics()
    {
        $this->signIn();

        $owner = factory('App\Owner')->create();

        $this->post($owner->path() .'/specifics', ['body' => 'Test specific'])

        	->assertStatus(403);

        $this->assertDatabaseMissing('specifics', ['body' => 'Test specific']);
    }

        /** @test */

    public function only_the_user_of_an_owner_may_update_a_specific()
    {
    	// $this->withoutExceptionHandling();

        $this->signIn();

        $owner = OwnerFactory::withSpecifics(1)->create();

        /*$owner = factory('App\Owner')->create();

        $specific = $owner->addSpecific('test specific');*/

        $this->patch($owner->specifics[0]->path(), ['body' => 'changed'])

        	->assertStatus(403);

        $this->assertDatabaseMissing('specifics', ['body' => 'changed']);
    }

    /** @test */

    public function an_owner_can_have_specifics()
    {
        /*$this->signIn();

		$owner = factory(Owner::class)->create(['user_id' => auth()->id()]);*/

		$owner = OwnerFactory::create();

		$this->actingAs($owner->user)

			->post($owner->path() .'/specifics', ['body' => 'First specific']);

		$this->get($owner->path())

		->assertSee('First specific');        
    }

    /** @test */

    public function a_specific_can_be_updated()
    {
    	// $this->withoutExceptionHandling();

    	$owner = OwnerFactory::withSpecifics(1)->create();

    		// app(OwnerFactory::class)

    		// ->ownedBy($this->signIn())

    		/*->withSpecifics(1)

    		->create();*/

		/*$owner = auth()->user()->owners()->create(factory(Owner::class)->raw());

		// $owner = factory(Owner::class)->create(['user_id' => auth()->id()]);

		$specific = $owner->addSpecific('test specific');*/

		$this->actingAs($owner->user)

			->patch($owner->specifics[0]->path(),

							/*->specifics->first()->path(),*/ 
				[
					'body' => 'changed'
				]);

		$this->assertDatabaseHas('specifics', 
			[
				'body' => 'changed'
			]);
    }

    /** @test */

    public function a_specific_can_be_specified()
    {
    	// $this->withoutExceptionHandling();

    	$owner = OwnerFactory::withSpecifics(1)->create();

		$this->actingAs($owner->user)

			->patch($owner->specifics[0]->path(),

							/*->specifics->first()->path(),*/ 
				[
					'body' => 'changed',

					'specified' => true
				]);

		$this->assertDatabaseHas('specifics', 
			[
				'body' => 'changed',

				'specified' => true
			]);
    }

    /** @test */

    public function a_specific_can_be_marked_as_unspecified()
    {
    	// $this->withoutExceptionHandling();

    	$owner = OwnerFactory::withSpecifics(1)->create();

		$this->actingAs($owner->user)

			->patch($owner->specifics[0]->path(),

							/*->specifics->first()->path(),*/ 
				[
					'body' => 'changed',

					'specified' => true
				]);

		$this->patch($owner->specifics[0]->path(),

							/*->specifics->first()->path(),*/ 
				[
					'body' => 'changed',

					'specified' => false
				]);

		$this->assertDatabaseHas('specifics', 
			[
				'body' => 'changed',

				'specified' => false
			]);
    }

    /** @test */

    public function a_specific_requires_a_body()
    {
    	/*$this->signIn();

    	$owner = factory(Owner::class)->create(['user_id' => auth()->id()]);*/

    	$owner = OwnerFactory::create();

    	$attributes = factory('App\Specific')->raw(['body' => '']);

        $this->actingAs($owner->user)

        	->post($owner->path() . '/specifics', $attributes)

        	->assertSessionHasErrors('body');
    }
}
