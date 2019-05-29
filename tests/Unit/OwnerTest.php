<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OwnerTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
     
    public function it_has_a_path()
    {
    	$owner = factory('App\Owner')->create();

    	$this->assertEquals('/owners/' . $owner->id, $owner->path());
    }
}
