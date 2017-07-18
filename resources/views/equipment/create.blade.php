@extends('layouts.app')

@section('content')
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
		{!! Form::open(['method'=>'POST', 'action'=>'EquipmentController@store', 'class'=>'ui form']) !!}
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
				{!! Form::submit('Cadastrar', ['class'=>'ui positive button']) !!}
			</div>
		{!! Form::close() !!}
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$('.message .close').on('click', function() {
			$(this).closest('.message').transition('fade');
		});
	</script>
@stop
