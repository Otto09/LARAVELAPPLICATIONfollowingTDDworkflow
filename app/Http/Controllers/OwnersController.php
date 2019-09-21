<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;

class OwnersController extends Controller
{
	public function index()
	{
		$owners = auth()->user()->accessibleOwners();

		return view('owners.index', compact('owners'));
	}

	public function show(Owner $owner)
	{
		$this->authorize('update', $owner);
		
		/*if (auth()->user()->isNot($owner->user))
		{
			abort(403);	
		}*/

		return view('owners.show', compact('owner'));
	}

	public function create()
	{
		return view('owners.create');
	}

	public function store()
	{
		//validate

		/*$attributes =  request()->validate([

			'owner' => 'required',

			'animal' => 'required', 

						// |max:100,

			'remarks' => 'min:3'
		]);*/

		//$attributes['user_id'] = auth()->id();

		//persist

		$owner = auth()->user()->owners()->create($this->validateRequest());

		if ($specifics = request('specifics')) {
				
			$owner->addSpecifics($specifics);

		}

		if (request()->wantsJson()) {
			
			return ['message' => $owner->path()];

		}

		//redirect

		return redirect($owner->path());
	}

	public function edit(Owner $owner)
	{
		return view('owners.edit', compact('owner'));
	}

	public function update(Owner $owner)
	{
		$this->authorize('update', $owner);

		/*if (auth()->user()->isNot($owner->user))
		{
			abort(403);	
		}*/

		/*$attributes =  request()->validate([

			'owner' => 'required',

			'animal' => 'required', 

						// |max:100,

			'remarks' => 'min:3'
		]);*/
		
		$owner->update($this->validateRequest());

		/*$owner->update(
		[
			'remarks' => request('remarks')
		]);*/
		return redirect($owner->path());
	}

	public function destroy(Owner $owner)
	{
		$this->authorize('manage', $owner);
		
		$owner->delete();

		return redirect('/owners');
	}

	protected function validateRequest()
	{
		return request()->validate([

			'owner' => 'sometimes|required',

			'animal' => 'sometimes|required', 

						// |max:100,

			'remarks' => 'nullable'
		]);
	}
}
