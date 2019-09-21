<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Owner;

use App\Specific;

class OwnerSpecificsController extends Controller
{
    public function store(Owner $owner)
    {
    	$this->authorize('update', $owner);
    	
        /*if (auth()->user()->isNot($owner->user))
        {
            abort(403);
        }*/

    	request()->validate(['body' => 'required']);

    	$owner->addSpecific(request('body'));

    	return redirect($owner->path());
    }

    public function update(Owner $owner, Specific $specific)
    {
    	$this->authorize('update', $specific->owner);

        /*if (auth()->user()->isNot($specific->owner->user))
        {
            abort(403);
        }*/

		$specific->update(request()->validate(['body' => 'required']));

		request('specified') ? $specific->specify() : $specific

			->unspecify();

		

		/*if (request('specified')) {

			$specific->specify();

		} else {

			$specific->unspecify();

		}*/

    	// $specific->update([

    	// 		'body' => request('body'),

    	// 		'specified' => request()->has('specified')
    	// 	]);

    	// $specific->specify();

    	return redirect($owner->path());
    }
}
