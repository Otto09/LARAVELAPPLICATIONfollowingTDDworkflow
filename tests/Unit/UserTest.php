<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\OwnerFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
	use RefreshDatabase;

    /** @test */

    public function an_user_has_owners()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->owners);
    }

    /** @test */

    public function an_user_has_accessible_owners()
    {
    	$john = $this->signIn();

    	OwnerFactory::ownedBy($john)->create();

    	$this->assertCount(1, $john->accessibleOwners());

    	$sally = factory(User::class)->create();

    	$nick = factory(User::class)->create(); 

    	$owner = tap(OwnerFactory::ownedBy($sally)->create())->invite($nick);

    	$this->assertCount(1, $john->accessibleOwners());

    	$owner->invite($john);

    	$this->assertCount(2, $john->accessibleOwners());
    }
}
