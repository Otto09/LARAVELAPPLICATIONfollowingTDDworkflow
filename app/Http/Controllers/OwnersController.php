<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;

class OwnersController extends Controller
{
	public function index()
	{
		$owners = Owner::all();

		return view('owners.index', compact('owners'));
	}

	public function show(Owner $owner)
	{		
		return view('owners.show', compact('owner'));
	}

	public function store()
	{
		//validate

		$attributes =  request()->validate([

			'owner' => 'required',

			'animal' => 'required'
		]);

		//persist

		Owner::create($attributes);

		//redirect

		return redirect('/owners');
	}
}
