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
					<h2 class="ui dividing header">Empréstimo</h2>
					<div class="fields">
						<div class="eight wide required field {{ $errors->loanErrors->has('student_enrollment') ? 'error' : '' }}">
							{!! Form::label('student_enrollment', 'Matrícula') !!}
							{!! Form::text('student_enrollment', null, ['placeholder'=>'Matrícula do Aluno', 'data-mask' => '0000000000']) !!}
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
					<h2 class="ui dividing header">Devolução</h2>
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
		<table class="ui teal fixed celled table" id="loansTable">
			<thead>
				<tr>
					<th class="center aligned two wide">Matrícula do Aluno</th>
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
						<td class="center aligned"><a href='/students/{{$loan->student->id}}'>{{$loan->student->enrollment}}</a></td>
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
		});

		$('.message .close').on('click', function() {
			$(this).closest('.message').transition('fade');
		});
	</script>
@stop