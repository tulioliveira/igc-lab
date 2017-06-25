@extends('layouts.app')

@section('content')
<div class="ui segment raised">
	<form class="ui form" method="POST" action="/equipment">
		{{csrf_field()}}
		<h4 class="ui dividing header">Cadastrar Equipamento</h4>
		<div class="required field">
			<label>Código</label>
			<input type="text" name="id" placeholder="Código do Equipamento">
		</div>
		<div class="required field">
			<label>Nome</label>
			<input type="text" name="name" placeholder="Nome do Equipamento">
		</div>
		<div class="required field">
			<label>Descrição</label>
			<textarea name="description" rows="3"></textarea>
		</div>
		<button class="ui button fluid primary" type="submit">Cadastrar</button>
	</form>
</div>
@stop
