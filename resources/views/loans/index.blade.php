@extends('layouts.app')

@section('content')
	@include('barcode-modal')
	<h1 class="ui center aligned icon header">
		<i class="exchange icon"></i>
		Empréstimos
	</h1>
	@if($errors->loanErrors->any())
		<div class="ui error message">
			<i class="close icon"></i>
			<div class="header">
				O formulário de empréstimo apresentou os seguintes erros:
			</div>
			<ul class="list">
				@foreach($errors->loanErrors->all() as $message)
					<li>{{$message}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	@if($errors->returnErrors->any())
		<div class="ui error message">
			<i class="close icon"></i>
			<div class="header">
				O formulário de devolução apresentou os seguintes erros:
			</div>
			<ul class="list">
				@foreach($errors->returnErrors->all() as $message)
					<li>{{$message}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="ui two column grid">
		<div class="column">
			<div class="ui segment raised">
				{!! Form::open(['method'=>'POST', 'action'=>'LoansController@store', 'class'=>'ui form']) !!}
					{{csrf_field()}}
					<h2 class="ui dividing header" data-content="Preencha os campos abaixo para realizar o empréstimo de um equipamento. Ao realizar um novo empréstimo, o sistema irá automaticamente efetuar a devolução do equipamento para qualquer empréstimo em aberto no horário atual" data-position="top left" data-variation="wide">Empréstimo</h2>
					<div class="inline fields">
						<div class="field">
							<div class="ui radio checkbox">
								{!! Form::radio('user_type', 'Aluno', true) !!}
								{!! Form::label('user_type', 'Aluno') !!}
							</div>
						</div>
						<div class="field">
							<div class="ui radio checkbox">
								{!! Form::radio('user_type', 'Servidor') !!}
								{!! Form::label('user_type', 'Servidor') !!}
							</div>
						</div>
					</div>
					<div class="fields">
						<div class="eight wide required field {{ $errors->loanErrors->has('user_enrollment') ? 'error' : '' }}">
							{!! Form::label('user_enrollment', 'Matrícula') !!}
							{!! Form::text('user_enrollment', null) !!}
						</div>
						<div class="eight wide required field {{ $errors->loanErrors->has('loan_equipment_code') ? 'error' : '' }}">
							{!! Form::label('loan_equipment_code', 'Código') !!}
							<div class="ui icon input">
								{!! Form::text('loan_equipment_code', null, ['placeholder'=>'Código do Equipamento']) !!}
								<i class="bordered barcode inverted grey link icon" id="barcodeReader"></i>
							</div>

						</div>
					</div>
					<div class="fields">
						<div class="sixteen wide required field {{ $errors->has('deadline') ? 'error' : '' }}">
							{!! Form::label('deadline', 'Data Limite para Devolução') !!}
							<div class="ui calendar" id="deadlineCalendar">
								{!! Form::text('deadline', Carbon\Carbon::today()->format('D/M/Y'), ['placeholder'=>'Data limite']) !!}
							</div>
						</div>
					</div>

					{!! Form::submit('Emprestar', ['class'=>'ui primary button']) !!}
				{!! Form::close() !!}
			</div>
		</div>
		<div class="column">
			<div class="ui segment raised">
				{!! Form::open(['method'=>'POST', 'action'=>'LoansController@return', 'class'=>'ui form']) !!}
					{{csrf_field()}}
					<h2 class="ui dividing header" data-content="Preencha o campo de devolução com o código do equipamento a ser devolvido digitando-o ou por meio do leitor de código de barra. O sistema irá efetuar a devolução do equipamento para o horário atual" data-position="top left" data-variation="wide">Devolução</h2>
					<div class="required field {{ $errors->returnErrors->has('return_equipment_code') ? 'error' : '' }}">
						{!! Form::label('return_equipment_code', 'Código') !!}
						<div class="ui icon input">
							{!! Form::text('return_equipment_code', null, ['placeholder'=>'Código do Equipamento']) !!}
							<i class="bordered barcode inverted grey link icon" id="barcodeReader"></i>
						</div>
					</div>
					{!! Form::submit('Devolver', ['class'=>'ui secondary button']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
	@if (count($loans) == 0)
		<div class="ui icon warning message">
			<i class="huge comments outline icon"></i>
			<div class="content">
				<div class="header">
					Nenhum empréstimo encontrado
				</div>
			</div>
		</div>
	@else
		<div class="ui two column center aligned grid" @if($loans->lastPage() > 1) data-content="A tabela de empréstimos é paginada de 20 em 20 items. Use o paginador para alterar entre as páginas" data-position="top center" data-variation="flowing" @endif  id="loansTable" >
			<div class="column">
				{{$loans->links()}}
			</div>
		</div>
		<table class="ui teal fixed celled table" data-content="Empréstimos em atraso serão exibidos em vermelho" data-position="top right" data-variation="wide">
			<thead>
				<tr>
					<th class="center aligned two wide">Matrícula do Usuário</th>
					<th class="center aligned two wide">Código do Equipamento</th>
					<th class="center aligned three wide">Data do Empréstimo</th>
					<th class="center aligned three wide">Data Limite para Devolução</th>
					<th class="center aligned three wide">Data de Devolução</th>
					<th class="center aligned three wide">Estado</th>
				</tr>
			</thead>
			<tbody>
				@foreach($loans as $loan)
					<tr @if($loan->isLate()) class="error" @endif>
						<td class="center aligned"><a href='/users/{{$loan->user->id}}'>{{$loan->user->enrollment}}</a></td>
						<td class="center aligned"><a href='/equipment/{{$loan->equipment->id}}'>{{$loan->equipment->code}}</a></td>
						<td class="center aligned">{{$loan->loaned_on->format('d/m/Y H:i:s')}}</td>
						<td class="center aligned">{{$loan->deadline->format('d/m/Y H:i:s')}}</td>
						<td class="center aligned">{{$loan->returned_on ? $loan->returned_on->format('d/m/Y H:i:s') : ''}}</td>
						<td class="center aligned">{{$loan->status()}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

	
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('.ui.checkbox').checkbox();

			if ($('input[type=radio][name=user_type]:checked').val() == "Aluno") {
				$('#user_enrollment').attr("placeholder", "Matrícula do Aluno");
				$('#user_enrollment').mask("0000000000");
			}
			else {
				$('#user_enrollment').attr("placeholder", "Matrícula do Servidor");
				$('#user_enrollment').mask("000000-0");
			}

			var today = new Date();
			$('#deadlineCalendar').calendar({
				type: 'date',
				ampm: false,
				initialDate: null,
				minDate: today,
				text: {
					days: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
					months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'May', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
					monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
					today: 'Hoje',
					now: 'Agora',
					am: 'AM',
					pm: 'PM'
				},
				formatter: {
					date: function (date, settings) {
						if (!date) return '';
						var day = ('0' + date.getDate()).slice(-2);
						var month = ('0' + (date.getMonth() + 1)).slice(-2);
						var year = date.getFullYear();
						return day + '/' + month + '/' + year;
					}
				}
			});

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
								$("input#return_equipment_code").val(barcode);
								$("input#loan_equipment_code").val(barcode);
								$('.ui.barcode.modal').modal('hide');
							}
							chars = [];
							pressed = false;
						},500);
					}
					pressed = true;
				}
			});

			var field = 'page';
			var url = window.location.href;
			if((url.indexOf('?page=') != -1) || (url.indexOf('&page=') != -1))
				$('html, body').animate({scrollTop: $('#usersTable').offset().top}, 500);
		});

		$('input[type=radio][name=user_type]').change(function() {
			if (this.value == 'Aluno') {
				$('#user_enrollment').attr("placeholder", "Matrícula do Aluno");
				$('#user_enrollment').mask("0000000000");
			}
			else {
				$('#user_enrollment').attr("placeholder", "Matrícula do Servidor");
				$('#user_enrollment').mask("000000-0");
			}
		});
	</script>
@stop