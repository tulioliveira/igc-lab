@extends('layouts.app')

@section('content')
	<form method="post" action="/students">
		<input type="text" name="id" />
		<input type="text" name="cpf" />
	</form>
@stop
