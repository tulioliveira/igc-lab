@extends('layouts.app')

@section('content')
	@include('barcode-modal')
	@if (isset($equipment))
		@if($errors->any())
			<div class="ui error message">
				<i class="close icon"></i>
				<div class="header">
					O formulário de edição apresentou os seguintes erros:
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
				<h2 class="ui dividing header">Editar Equipamento</h2>
				<div class="fields">
					<div class="eight wide required field {{ $errors->has('code') ? 'error' : '' }}">
						{!! Form::label('code', 'Código') !!}
						<div class="ui icon input">
							{!! Form::text('code', null, ['placeholder'=>'Código do Equipamento']) !!}
							<i class="bordered barcode inverted grey link icon" id="barcodeReader"></i>
						</div>
					</div>
					<div class="eight wide required field {{ $errors->has('name') ? 'error' : '' }}">
						{!! Form::label('name', 'Nome') !!}
						{!! Form::text('name', null, ['placeholder'=>'Nome do Equipamento']) !!}
					</div>
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
			<a class="ui primary button" href="/equipment"><i class="icon left arrow"></i>Voltar</a>
		</div>
	@endif
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('i#barcodeReader').on('click', function(e){
				$('.ui.barcode.modal').modal('show');
			});

			var pressed = false; 
			var chars = []; 
			$(window).keypress(function(e) {
				if($('.ui.barcode.modal').is(":visible")){
					if (e.which >= 48 && e.which <= 57) {
						chars.push(String.fromCharCode(e.which));
					}
					if (pressed == false) {
						setTimeout(function(){
							if (chars.length >= 10) {
								var barcode = chars.join("");
								$("input#code").val(barcode);
								$('.ui.barcode.modal').modal('hide');
							}
							chars = [];
							pressed = false;
						},500);
					}
					pressed = true;
				}
			});
		});
	</script>
@stop