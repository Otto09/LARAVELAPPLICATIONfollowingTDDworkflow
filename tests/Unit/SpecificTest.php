<?php

namespace Tests\Unit;

use App\Owner;
use App\Specific;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpecificTest extends TestCase
{
	use RefreshDatabase;

	/** @test */

	function it_belongs_to_an_owner()
	{
		// $this->withoutExceptionHandling();

		$specific = factory(Specific::class)->create();

		$this->assertInstanceOf(Owner::class, $specific->owner);
	}

	/** @test */

	function it_has_a_path()
	{
		// $this->withoutExceptionHandling();
		
		$specific = factory(Specific::class)->create();

		$this->assertEquals("/owners/{$specific->owner->id}/specifics/{$specific->id}", 

			$specific->path());
	}

	/** @test */

	function it_can_be_specified()
	{
		$specific = factory(Specific::class)->create();

		$this->assertFalse($specific->specified);

		$specific->specify();

		$this->assertTrue($specific->fresh()->specified);
	}

	/** @test */

	function it_can_be_unspecified()
	{
		$specific = factory(Specific::class)->create(['specified' => true]);

		$this->assertTrue($specific->specified);

		$specific->unspecify();

		$this->assertFalse($specific->fresh()->specified);
	}	
}
