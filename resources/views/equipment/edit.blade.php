@extends('layouts.app')

@section('content')
	@if (isset($equipment))
		@if($errors->any())
			<div class="ui error message">
				<i class="close icon"></i>
				<div class="header">
					O formulário de criação apresentou alguns erros:
				</div>
				<ul class="list">
					@foreach($errors->all() as $message)
						<li>{{$message}}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="ui segment raised">
			{!! Form::model($equipment, ['method'=>'PATCH', 'action'=>['EquipmentController@update', $equipment->id], 'class'=>'ui form']) !!}
				{{csrf_field()}}
				<h4 class="ui dividing header">Cadastrar Equipamento</h4>
				<div class="required field {{ $errors->has('code') ? 'error' : '' }}">
					{!! Form::label('code', 'Código') !!}
					{!! Form::text('code', null, ['placeholder'=>'Código do Equipamento']) !!}
				</div>
				<div class="required field {{ $errors->has('name') ? 'error' : '' }}">
					{!! Form::label('name', 'Nome') !!}
					{!! Form::text('name', null, ['placeholder'=>'Nome do Equipamento']) !!}
				</div>
				<div class="required field {{ $errors->has('description') ? 'error' : '' }}">
					{!! Form::label('description', 'Descrição') !!}
					{!! Form::textarea('description', null, ['rows'=>'3']) !!}
				</div>
				<div class="ui buttons fluid">
					<a class="ui button" href="/equipment">Cancelar</a>
					<div class="or" data-text="ou"></div>
					{!! Form::submit('Salvar', ['class'=>'ui positive button']) !!}
				</div>
			{!! Form::close() !!}
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
	<script type="text/javascript">
		$('.message .close').on('click', function() {
			$(this).closest('.message').transition('fade');
		});
	</script>
@stop