<?php

namespace App;

trait RecordsActivity
{
    public $oldAttributes = [];

    /**
    *
    * Boot the trait
    *
    */
    public static function bootRecordsActivity()
    {
    	foreach (self::recordableEvents() as $event) {
    		
    		static::$event(function ($model) use ($event) {

    			$model->recordActivity($model->activityExplanation($event));

    		});

    		if ($event === 'updated') {

		    	static::updating(function ($model) {

	    			$model->oldAttributes = $model->getOriginal();

	    		});
	    	}
    	}
    }

    protected function activityExplanation($explanation)
    {
		return "{$explanation}_" . strtolower(class_basename($this));

		//created_specific	
    } 

    /**
    * @return array
    */
    protected static function recordableEvents()
    {
    	if (isset(static::$recordableEvents)) {

    		return static::$recordableEvents;
    		
		}

		return ['created', 'updated'];
    }

    /**
    * Record activity for an owner.
    *
    * @param string $explanation
    */
    public function recordActivity($explanation)
    {
    	$this->activity()->create([

    		'user_id' => class_basename($this) === 'Owner' ? $this->user->id : $this
    			
    			->owner->user->id,

    		'explanation' => $explanation,

    		'changes' => $this->activityChanges(),

    		'owner_id' => class_basename($this) === 'Owner' ? $this->id : $this

    			->owner_id

    	]);

        // Activity::create([

        //     'owner_id' => $this->id,

        //     'explanation' => $type

        // ]);
    }

    /*protected function activityOwner()
    {
    	if (auth()->check()) {

    		return auth()->user();

    	}*/

    	// return ($this->owner ?? $this)->user;

    	/* return class_basename($this) === 'Owner' ? $this->user : $this->owner

    		->user;*/

    	/*if (class_basename($this) === 'Owner') {

    		return $this->user;

    	}*/

    	// return $this->owner->user;
    // }
   
	public function activity()
    {
    	return $this->morphMany(Activity::class, 'subject')->latest();
    }

    protected function activityChanges()
    {
    	if ($this->wasChanged()) {

    		return [

			'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()),

				'updated_at'),

			'after' => array_except($this->getChanges(), 'updated_at')

			];

    	}
    }
}