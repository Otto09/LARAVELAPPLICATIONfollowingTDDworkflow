<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $guarded = [];

    public function path()
    {
    	return "/owners/{$this->id}";
    }
}
