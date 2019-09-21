<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specific extends Model
{
	use RecordsActivity;

    protected $guarded = [];

    protected $touches = ['owner'];

    protected $casts = [

    	'specified' => 'boolean'

    ];

    protected static $recordableEvents = ['created', 'deleted'];

    /*protected static function boot()
    {
    	parent::boot();

    	static::created(function ($specific) {

			$specific->owner->recordActivity('created_specific');

	    	// Activity::create([

	    	// 	'owner_id' => $specific->owner->id,

	    	// 	'explanation' => 'created_specific'

	    	// ]);

    	});

    	static::updated(function ($specific) {

    		if (! $specific->specified) return;

    		$specific->owner->recordActivity('specified_specific');

	    	// Activity::create([

	    	// 	'owner_id' => $specific->owner->id,

	    	// 	'explanation' => 'specified_specific'

	    	// ]);

    	});

    	static::deleted(function ($specific) {

			$specific->owner->recordActivity('deleted_specific');

		});
    }*/

    public function specify()
    {
    	$this->update(['specified' => true]);

    	$this->recordActivity('specified_specific');
    }

    public function unspecify()
    {
    	$this->update(['specified' => false]);

    	$this->recordActivity('unspecified_specific');
    }

    public function owner()
    {
    	return $this->belongsTo(Owner::class);
    }

    public function path()
    {
    	return "/owners/{$this->owner->id}/specifics/{$this->id}";
    }
}
