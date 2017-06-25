<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="UTF-8">
	<title>Lab IGC</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('semantic-ui/semantic.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/app.css')}}">
</head>
<body>

	<div class="ui attached menu inverted margin bottom small">
		<div class="ui container">
			<a class="header item" href="/">
			   Laboratório IGC
			</a>
			<a class="item" href="/students"> 
				Alunos 
			</a>
			<a class="item" href="/equipment">
				Equipamentos
			</a>    
		</div>
		
	</div>

	<div class="ui container">
		@yield('content')
	</div>
	
	<!-- Scripts -->
	<script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('semantic-ui/semantic.min.js')}}"></script>

	@yield('scripts')
</body>
</html>