@extends('layouts.app')

@section('content')
	@if (isset($equipment))
		<div class="ui segment raised" >
			<h1 class="ui header" data-content="Nome do equipamento" data-position="center left">
				{{$equipment->name}} 
				<div class="ui label" data-content="Código do equipamento" data-position="center right">
					<i class="settings icon"></i> Id:{{$equipment->id}}
				</div>
				<a class="ui button primary right floated" href="/equipment/{{$equipment->id}}/edit" data-content="Editar as informações do equipamento">Editar</a>
			</h1>
			{{$equipment->description}}
			
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
