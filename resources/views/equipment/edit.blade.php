@extends('layouts.app')

@section('content')
	@if (isset($equipment))
		<div class="ui segment raised">
		<form class="ui form" method="POST" action="/equipment/{{$equipment->id}}">
				{{csrf_field()}}
				<input type="hidden" name="_method" value="PUT">
				<h4 class="ui dividing header">Editar Equipamento</h4>
				<div class="required field">
					<label>Código</label>
					<input type="text" name="id" placeholder="Código do Equipamento" value={{$equipment->id}}>
				</div>
				<div class="required field">
					<label>Nome</label>
					<input type="text" name="name" placeholder="Nome do Equipamento" value={{$equipment->name}}>
				</div>
				<div class="required field">
					<label>Descrição</label>
					<textarea name="description" rows="3">{{$equipment->description}}</textarea>
				</div>
				<div class="ui buttons fluid">
					<a class="ui button" href="/equipment">Cancelar</a>
					<div class="or" data-text="ou"></div>
					<button class="ui positive button" type="submit">Salvar</button>
				</div>
			</form>
		</div>
	@else
		<h1 class="ui center red aligned icon header">
			<i class="remove circle red icon"></i>
			Erro
		</h1>
		<h2 class="ui center aligned header">
			Esse equipamento não existe!
		</h2>
		<div class="ui container center aligned">
			<a class="ui primary button" href="/equipment">Voltar</a>
		</div>
	@endif
@stop

@section('scripts')

@stop