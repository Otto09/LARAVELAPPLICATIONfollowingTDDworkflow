<?php

/**
 * 
 */

namespace Tests\Setup;

use App\Owner;
use App\Specific;
use App\User;

class OwnerFactory
{
	protected $specificsCount = 0;

	protected $user;

	public function withSpecifics($count)
	{
		$this->specificsCount = $count;

		return $this;
	}

	public function ownedBy($user)
	{
		$this->user = $user;

		return $this;
	}

	public function create()
	{
		$owner = factory(Owner::class)->create(
		[
			'user_id' => $this->user ?? factory(User::class)
		]);

		factory(Specific::class, $this->specificsCount)->create(
		[
			'owner_id' => $owner->id
		]);

		return $owner;
	}
}
