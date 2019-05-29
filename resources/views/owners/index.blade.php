<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Animalboard</h1>

	<ul>
		@foreach ($owners as $owner)

		<li>{{ $owner->owner }}</li>

		@endforeach
	</ul>
</body>
</html>
