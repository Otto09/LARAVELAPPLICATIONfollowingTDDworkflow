@extends('layouts.app')


@section('content')

	<header class="flex items-center mb-3 pb-4">

		<div class="flex justify-between items-end w-full">

			<p class="text-default font-normal">

				<a href="/owners">My Owners</a> / {{ $owner->owner }}

			</p>

			<div class="flex">
			
				@foreach ($owner->members as $member)

				<img src="{{ gravatar_url($member->email) }}"
					
					alt="{{ $member->name }}'s avatar" 

					class="mr-2 rounded-full">

				@endforeach

				<img src="{{ gravatar_url($owner->user->email) }}" 
					
					alt="{{$owner->user->name}}'s avatar" 

					class="mr-2 rounded-full">
				
				<a href="{{ $owner->path().'/edit' }}" class="button ml-4">

					Edit Owner

				</a>
				
			</div>

		</div>

	</header>

	<main>

		<div class="md:flex -m-3">
		
			<div class="md:w-3/4 px-3 mb-6">

				<div class="mb-8">

					<h2 class="text-default font-normal text-lg mb-3">Specifics</h2>

					{{-- specifics --}}

					@foreach ($owner->specifics as $specific)

					<div class="card mb-3">

						<form method="POST" 

						action="{{ $specific->path() }}">

							@method('PATCH')

							@csrf

							<div class="flex">

								<input name="body" value="{{ $specific->body }}"
																					
								class="{{$specific->specified ? 'text-default' : 

									''}}

								w-full bg-card text-default">
	
								<input type="checkbox" name="specified" 

								onChange="this.form.submit()"							

								{{ $specific->specified ? 'checked' : '' }}>

							</div>

						</form>

					</div>

					@endforeach

					<div class="card mb-3">

						<form action="{{ $owner->path() . '/specifics' }}" method="

							POST">

							@csrf
					
							<input placeholder="Add a new specific..." name="body" 

							class="w-full bg-card text-default">

						</form>
					
					</div>

				</div>

				<div>

					<h2 class="text-default font-normal text-lg mb-3">Remarks </h2>

					{{--remarks --}}

					<form method="POST" action="{{ $owner->path() }}">

						@csrf

						@method('PATCH')
						
						<textarea class="card w-full mb-4 text-default" 

						style="min-height: 200px" placeholder="Have you any remarks?" 
						name="remarks">

							{{ $owner->remarks }}

						</textarea>

						<button type="submit" class="button">Save</button>

					</form>

					<!-- <dropdown width="100%">

						<template v-slot:trigger>
						
							<a href="#">Click Me</a>

						</template>


						<a href="#" class="block text-default hover:underline leading-loose text-xs px-6">
                                        Item 1
                        </a>

                        <a href="#" class="block text-default hover:underline leading-loose text-xs px-6">
                            Item 2
                        </a>

                        <a href="#" class="block text-default hover:underline leading-loose text-xs px-6">
                            Item 3
                        </a>

					</dropdown> -->

					@include('errors')

				</div>

			</div>

			<div class="md:w-1/4 px-3 md:py-8">

				@include ('owners.card')

				@include ('owners.activity.card')

				@can ('manage', $owner)

					@include ('owners.invite')

				@endcan
				
			</div>

		</div>

	</main>

@endsection