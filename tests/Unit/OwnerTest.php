<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OwnerTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
     
    public function it_has_a_path()
    {
    	$owner = factory('App\Owner')->create();

    	$this->assertEquals('/owners/' . $owner->id, $owner->path());
    }

    /** @test */

    public function it_belongs_to_an_user()
    {
		$owner = factory('App\Owner')->create();

		$this->assertInstanceOf('App\User', $owner->user);
    }

    /** @test */

 	public function it_can_add_a_specific()
 	{
 		// $this->withoutExceptionHandling();

 		$owner = factory('App\Owner')->create();

 		$specific = $owner->addSpecific('First specific');

 		$this->assertCount(1, $owner->specifics);

 		$this->assertTrue($owner->specifics->contains($specific));
 	}

 	/** @test */

 	public function it_can_invite_an_user()
 	{
 		$owner = factory('App\Owner')->create();

 		$owner->invite($user = factory(User::class)->create());

        $this->assertTrue($owner->members->contains($user));
 	}   
}
