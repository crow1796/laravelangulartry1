<!DOCTYPE html>
<html lang="en" data-ng-app="fileUploader">
<head>
	@include('layout.partials._assets')	
</head>
<body>
	@include('layout.partials._header')

	<div class="container">
		@yield('content')
	</div>

	@include('layout.partials._footer')
</body>
</html>