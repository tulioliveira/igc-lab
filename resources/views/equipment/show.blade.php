@extends('layouts.app')

@section('content')
	@if (isset($equipment))
		<div class="ui segment raised" >
			<div class="ui grid">
				<div class="twelve wide column">
					<h1 class="ui header" data-content="Nome do equipamento" data-position="top left">
						{{$equipment->name}} 
						<div class="ui label" data-content="Código do equipamento" data-position="right center">
							<i class="settings icon"></i>Código: {{$equipment->code}}
						</div>
					</h1>
				</div>
				<div class="four wide column">
					{!! Form::open(['method'=>'DELETE', 'action'=>['EquipmentController@destroy', $equipment->id], 'class'=>'ui form']) !!}
						{{csrf_field()}}
						<div class="ui buttons right floated">
							<button class="ui animated fade button negative" tabindex="0" type="submit" data-content="Remover o equipamento do sistema" data-position="left center">
								<div class="visible content">Deletar</div>
								<div class="hidden content">
									<i class="icon remove"></i>
								</div>
							</button>
							<a class="ui animated fade button primary" tabindex="0" href="/equipment/{{$equipment->id}}/edit" data-content="Editar as informações do equipamento" data-variation="flowing" data-position="bottom center">
								<div class="visible content">Editar</div>
								<div class="hidden content">
									<i class="icon edit"></i>
								</div>
							</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
			<div class="ui divider"></div>
			<span class="ui" data-content="Descrição do equipamento" data-position="bottom left">{{$equipment->description}}</span>
			
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
			<a class="ui primary button" href="/equipment"><i class="icon left arrow"></i>Voltar</a>
		</div>
	@endif
@stop

@section('scripts')

@stop
