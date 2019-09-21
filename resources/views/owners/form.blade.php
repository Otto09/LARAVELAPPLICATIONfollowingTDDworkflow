@csrf

<!-- @method('PATCH') -->

<div class="field mb-6">
	
	<label class="label text-sm mb-2 block" for="owner">Owner</label>

	<div class="control">
		
		<input type="text" 

			class="input bg-transparent border border-grey-500 rounded p-2

			text-xs w-full" 

			name="owner" 

			placeholder="Owner"

			value="{{ $owner->owner }}"

			required

			>

	</div>


	<div class="field mb-6">
		
		<label class="label text-sm mb-2 block" for="animal">Animal</label>

		<div class="control">
			
			<input type="text" 
			
			class="input bg-transparent border border-grey-500 rounded p-2

				text-xs w-full" 
			
			name="animal"
			
			placeholder="Animal"

			value="{{ $owner->animal }}"

			required

			>		

		</div>

	</div>

	<div class="field mb-6">
		
		<div class="control">
			
			<button type="submit" class="button is-link mr-2">

				{{ $buttonText }}
			
			</button>

			<a href="{{ $owner->path() }}">Cancel</a>


		</div>

	</div>

	@if($errors->any())

		<div class="field mt-6">	

			@foreach($errors->all() as $error)

				<li class="text-sm text-red-600">{{ $error }}</li>

			@endforeach

		</div>

	@endif

</div>