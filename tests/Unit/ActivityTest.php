<?php

namespace Tests\Unit;

use App\Owner;
use App\User;
use Facades\Tests\Setup\OwnerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityTest extends TestCase
{
	use RefreshDatabase;
    
    /** @test */
    public function it_has_an_user()
    {
    	$user = $this->signIn();

        $owner = OwnerFactory::ownedBy($user)->create();

        $this->assertEquals($user->id, $owner->activity->first()->user->id);


    }
}
