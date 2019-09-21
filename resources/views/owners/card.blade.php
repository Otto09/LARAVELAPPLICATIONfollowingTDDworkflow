<div class="card flex flex-col" style="height: 200px">
	
	<h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-300 pl-4 mb-3">

		<a href="{{ $owner->path() }}" class="text-default">{{ $owner->owner }}</a>

	</h3>

	<div class="text-default mb-4 flex-1">{{ $owner->animal }}</div>

	@can('manage', $owner)

		<footer>
			
			<form method="POST" action="{{ $owner->path() }}" class="text-right">

				@method('DELETE')

				@csrf

				<button type="submit">Delete</button>

			</form>

		</footer>

	@endcan

</div>