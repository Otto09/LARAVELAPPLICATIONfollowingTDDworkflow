<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\OwnerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function nonowners_may_not_invite_users()
    {   
        $owner = OwnerFactory::create();

        $user = factory(User::class)->create();

        $assertInvitationForbidden = function () use ($user, $owner) {

            $this->actingAs($user)

                ->post($owner->path() . '/invitations')

                ->assertStatus(403);

        };

        $assertInvitationForbidden();

        $owner->invite($user);

        $assertInvitationForbidden();
    }

    /** @test */

    public function an_owner_can_invite_an_user()
    {
        // $this->withoutExceptionHandling();

        $owner = OwnerFactory::create();

        $userToInvite = factory(User::class)->create();

        $this->actingAs($owner->user)

            ->post($owner->path() . '/invitations', [

                'email' => $userToInvite->email

            ]) //invite a user

        ->assertRedirect($owner->path());

        $this->assertTrue($owner->members->contains($userToInvite));
    }

    /** @test */

    public function the_email_must_associate_animalboard_account()
    {
        $owner = OwnerFactory::create();

        $this->actingAs($owner->user)

            ->post($owner->path() . '/invitations', [

                'email' => 'notanuser@email.com'

            ])

            ->assertSessionHasErrors([
               
                'email' => 'The user must have animalboard account'

            ], null, 'invitations');
    }        

    /** @test */

    public function invited_users_may_update_owner_specifics()
    {
        //Given I have an owner

        $owner = OwnerFactory::create();

        //And the user of an owner can invite another user

        $owner->invite($newUser = factory(User::class)->create());

        //Than, that user have permission to add specifics

        $this->signIn($newUser);

        $this->post(action('OwnerSpecificsController@store', $owner), $specific = [

            'body' => 'Foo task'

        ]);

        $this->assertDatabaseHas('specifics', $specific);
    }
}
