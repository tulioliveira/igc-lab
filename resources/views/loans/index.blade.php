@extends('layouts.app')

@section('content')
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
							{!! Form::text('user_enrollment', null, ['placeholder'=>'Matrícula do Aluno', 'data-mask' => '0000000000']) !!}
						</div>
						<div class="eight wide required field {{ $errors->loanErrors->has('loan_equipment_code') ? 'error' : '' }}">
							{!! Form::label('loan_equipment_code', 'Código') !!}
							{!! Form::text('loan_equipment_code', null, ['placeholder'=>'Código do Equipamento']) !!}
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
						{!! Form::text('return_equipment_code', null, ['placeholder'=>'Código do Equipamento']) !!}
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
		<div class="ui two column center aligned grid" @if($loans->lastPage() > 1) data-content="A tabela de empréstimos é paginada de 20 em 20 items. Use o paginador para alterar entre as páginas" data-position="top center" data-variation="flowing" @endif>
			<div class="column">
				{{$loans->links()}}
			</div>
		</div>
		<table class="ui teal fixed celled table" id="loansTable" data-content="Empréstimos em atraso serão exibidos em vermelho" data-position="top right" data-variation="wide">
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

			$('#queryInput').on('keyup', function() {
				var value = $(this).val();
				var patt = new RegExp(value, "i");

				$('table#loansTable tbody').find('tr').each(function() {
					if (!($(this).find('td').text().search(patt) >= 0)) {
						$(this).hide();
					}
					if (($(this).find('td').text().search(patt) >= 0)) {
						$(this).show();
					}
				});
			});

			$('input[type=radio][name=user_type]').change(function() {
				if (this.value == 'Aluno') {
					$('#user_enrollment').val("");
					$('#user_enrollment').attr("placeholder", "Matrícula do Aluno");
					$('#user_enrollment').mask("0000000000");
				}
				else {
					$('#user_enrollment').val("");
					$('#user_enrollment').attr("placeholder", "Matrícula do Servidor");
					$('#user_enrollment').mask("000000-0");
				}
			});

			if ($('input[type=radio][name=user_type]').value != "Aluno") {
				$('#user_enrollment').mask("000000-0");
			}
		});

		$('.message .close').on('click', function() {
			$(this).closest('.message').transition('fade');
		});
	</script>
@stop