<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @test */

    public function signIn($user = null)
    {
    	$user = $user ?: factory('App\User')->create();

    	$this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);

    	return $user;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

