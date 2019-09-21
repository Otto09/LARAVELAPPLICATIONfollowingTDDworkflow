<div class="card mt-3">
					
	<ul class="text-sm">

		@foreach($owner->activity as $activity)

			<li class={{ $loop->last ? '' : 'mb-1' }}>

				@include ("owners.activity.{$activity

					->explanation}")

				<span class="text-gray-500">{{ $activity->created_at

					->diffForHumans(null, true) }}</span>

			</li>

		@endforeach

	</ul>

</div>