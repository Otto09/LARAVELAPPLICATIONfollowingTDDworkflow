@extends('layouts.app')


@section('content')


<div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">

	<h1 class="text-2xl font-normal mb-10 text-center">

		Create Owner

	</h1>


	<form 

		method="POST" 

		action="/owners"

	>


	@include('owners.form', [

		'owner' => new App\Owner,

		'buttonText' => 'Create Owner'	

	])


	</form>

</div>

	<!-- <form method="POST" 

		action="/owners"         

		class="md:w-1/2 md:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">

		@csrf
		
		<h1 class="text-2xl font-normal mb-10 text-center">Create an Owner</h1>

		
		<div class="field mb-6">
			
			<label class="label text-sm mb-2 block" for="owner">Owner</label>

			<div class="control">
				
				<input type="text" 

				class="input  bg-transparent border border-grey-500 rounded p-2

					text-xs w-full" 

				name="owner"

				placeholder="Owner">

			</div>

			<div class="field mb-6">
				
				<label class="label text-sm mb-2 block" for="animal">Animal</label>

				<div class="control">
					
					<input type="text" 

					class="input bg-transparent border border-grey-500 rounded p-2

						text-xs w-full" 

					name="animal"

					placeholder="Animal">		

				</div>

			</div>

			<div class="field">
				
				<div class="control">
					
					<button type="submit" class="button is-link mr-2">Create Owner
					
					</button>

					<a href="/owners">Cancel</a>


				</div>

			</div>

		</div>

	</form> -->

@endsection