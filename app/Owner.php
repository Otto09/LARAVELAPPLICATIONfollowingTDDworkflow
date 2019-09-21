<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
	use RecordsActivity;

    protected $guarded = [];

    public function path()
    {
    	return "/owners/{$this->id}";
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function specifics()
    {
    	return $this->hasMany(Specific::class);
    }

    public function addSpecifics($specifics)
    {
    	return $this->specifics()->createMany($specifics);
    }

    public function addSpecific($body)
    {
    	return $this->specifics()->create(compact('body'));
    }

    public function activity()
    {
    	return $this->hasMany(Activity::class)->latest();
    }

    public function invite(User $user)
    {
    	$this->members()->attach($user);
    }

    public function members()
    {
    	//is it true that an owner can belong to many members?

    	//and also a member can have access to many owners?

    	return $this->belongsToMany(User::class, 'owner_members')->withTimestamps();
    }
}
