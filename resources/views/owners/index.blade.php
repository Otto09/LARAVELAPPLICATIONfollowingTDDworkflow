@extends('layouts.app')


@section('content')

	<header class="flex items-center mb-5 py-4">

		<div class="flex justify-between items-end w-full">

			<h2 class="text-gray-500 font-normal">My Owners</h2>

			<a href="/owners/create" 

				class="button" 

				@click.prevent="$modal.show('new-owner')">New Owner</a>

		</div>

	</header>

	<main class="md:flex md:flex-wrap -mx-3">

		@forelse ($owners as $owner)
		
			<div class="md:w-1/3 px-3 pb-6">

				@include ('owners.card')

			</div>

	

		@empty

		<div>No owners yet.</div>

		@endforelse

	</main>

	<new-owner-modal></new-owner-modal>

@endsection