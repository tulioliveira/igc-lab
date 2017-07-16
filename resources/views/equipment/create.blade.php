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
		<div class="ui buttons fluid">
			<a class="ui button" href="/equipment">Cancelar</a>
			<div class="or" data-text="ou"></div>
			<button class="ui positive button" type="submit">Cadastrar</button>
		</div>
	</form>
</div>
@stop
