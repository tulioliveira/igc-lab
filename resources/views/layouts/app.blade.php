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
	<link rel="stylesheet" type="text/css" href="{{URL::asset('semantic-ui-calendar/calendar.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/app.css')}}">
</head>
<body>

	<div class="ui attached menu inverted margin bottom small main">
		<div class="ui container">
			<a class="header item" href="/">
				<h3 class="ui header inverted"><i class="home icon"></i>Laboratório IGC</h3>
			</a>
			<a class="item" href="/users"> 
				<i class="users icon"></i> Usuários 
			</a>
			<a class="item" href="/equipment">
				<i class="settings icon"></i>Equipamentos
			</a>
			<a class="item" href="/loans">
				<i class="exchange icon"></i>Empréstimos
			</a>
			<div class="right menu">
				<button class="item circular ui icon button" id="help-button" data-content="Coloque o cursor sobre esse ícone para exibir balões de ajuda na página!" data-variation="flowing" data-position="left center">
					<i class="icon help circle large"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="ui container margin bottom">
		@yield('content')
	</div>
	
	<!-- Scripts -->

	<script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('semantic-ui/semantic.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('semantic-ui-calendar/calendar.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('js/jquery.mask.min.js')}}"></script>
	@yield('scripts')
	<script type="text/javascript" src="{{URL::asset('js/help.js')}}"></script>
</body>
</html>