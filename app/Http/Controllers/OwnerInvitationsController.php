<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerInvitationRequest;
use App\Owner;
use App\User;
use Illuminate\Http\Request;

class OwnerInvitationsController extends Controller
{
    public function store(Owner $owner, OwnerInvitationRequest $request)
    {
    	/*$this->authorize('update', $owner);


    	request()->validate([

    		'email' => ['required', 'exists:users,email']

    	], [

            'email.exists' => 'The user must have animalboard account'

        ]);*/

    	$user = User::whereEmail(request('email'))->first();

    	$owner->invite($user);

    	return redirect($owner->path());
    }
}
