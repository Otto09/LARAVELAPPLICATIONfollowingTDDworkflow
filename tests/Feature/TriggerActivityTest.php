<?php

namespace Tests\Feature;

use App\Specific;
use Facades\Tests\Setup\OwnerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */

    public function creating_an_owner()
    {
    	// $this->withoutExceptionHandling();

        $owner = OwnerFactory::create();

        $this->assertCount(1, $owner->activity);       

    	tap($owner->activity->last(), function ($activity) {

    		$this->assertEquals('created_owner', $activity->explanation);

    		$this->assertNull($activity->changes);

    	});	
    }

    /** @test */

    public function updating_an_owner()
    {
    	$owner = OwnerFactory::create();

    	$originalOwner = $owner->owner;

    	$owner->update(['owner' => 'Changed']);

    	$this->assertCount(2, $owner->activity);

    	tap($owner->activity->last(), function ($activity) use ($originalOwner) {

    		$this->assertEquals('updated_owner', $activity->explanation);

    		$expected = [

    			'before' => ['owner' => $originalOwner],

    			'after' => ['owner' => 'Changed']

    		];

    		$this->assertEquals($expected, $activity->changes);

    	});	

    }

    /** @test */

    public function creating_a_new_specific()
    {
    	$owner = OwnerFactory::create();

    	$owner->addSpecific('Some specific');

    	$this->assertCount(2, $owner->activity);

    	tap($owner->activity->last(), function ($activity) {

    		// dd($activity->toArray());

    		$this->assertEquals('created_specific', $activity->explanation);

    		$this->assertInstanceOf(Specific::class, $activity->subject);

    		$this->assertEquals('Some specific', $activity->subject->body);

    	});

    	
    }

    /** @test */

    public function specifying_a_new_specific()
    {
    	$owner = OwnerFactory::withSpecifics(1)->create();

    	$this->actingAs($owner->user)

	    	->patch($owner->specifics[0]->path(), [

	    		'body' => 'foobar',

	    		'specified' => true

    		]);

    	$this->assertCount(3, $owner->activity);

    	    	tap($owner->activity->last(), function ($activity) {

    		// dd($activity->toArray());

	    	$this->assertEquals('specified_specific', $activity->explanation);

    		$this->assertInstanceOf(Specific::class, $activity->subject);

    	});

    }

    /** @test */

    public function unspecifying_a_new_specific()
    {
    	$owner = OwnerFactory::withSpecifics(1)->create();

    	$this->actingAs($owner->user)

	    	->patch($owner->specifics[0]->path(), [

	    		'body' => 'foobar',

	    		'specified' => true

	    	]);

    	$this->assertCount(3, $owner->activity);

    	$this->patch($owner->specifics[0]->path(), [

    		'body' => 'foobar',

    		'specified' => false

    	]);

    	// dd($owner->fresh()->activity->toArray());

    	$owner->refresh();

    	$this->assertCount(4, $owner->activity);

    	$this->assertEquals('unspecified_specific', $owner->activity->last()

    		->explanation);
    }


    /** @test */

    public function deleting_a_specific()
    {
    	$owner = OwnerFactory::withSpecifics(1)->create();

    	$owner->specifics[0]->delete();

    	$this->assertCount(3, $owner->activity);
    }    
}
