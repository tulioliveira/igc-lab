@extends('layouts.app')

@section('content')
	<h1 class="ui center aligned icon header">
		<i class="exchange icon"></i>
		Empréstimos
	</h1>
	<div class="ui form margin bottom small">
		<div class="fields">
			<div class="three wide field">
				<a class="ui animated fade button green fluid" tabindex="0" href="/students/create" data-content="Cadastrar um novo aluno no sistema" data-variation="wide" data-position="top left">
					<div class="visible content">Novo Aluno</div>
					<div class="hidden content">
						<i class="icon add"></i>
					</div>
				</a>
			</div>
			<div class="thirteen wide field">
				<div class="ui fluid icon input" data-content="Busca por qualquer linha da tabela que contenha os termos de busca" data-variation="very wide" data-position="top right">
					<input type="text" placeholder="Buscar alunos" name="query" id="queryInput">
					<i class="search icon"></i>
				</div>
			</div>
		</div>
	</div>
	@if($errors->any())
		<div class="ui error message">
			<i class="close icon"></i>
			<div class="header">
				O formulário de empréstimo apresentou os seguintes erros:
			</div>
			<ul class="list">
				@foreach($errors->all() as $message)
					<li>{{$message}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="ui segment raised">
		{!! Form::open(['method'=>'POST', 'action'=>'LoansController@store', 'class'=>'ui form']) !!}
			{{csrf_field()}}
			<h2 class="ui dividing header">Empréstimo</h2>
			<div class="fields">
				<div class="four wide required field {{ $errors->has('student_enrollment') ? 'error' : '' }}">
					{!! Form::label('student_enrollment', 'Matrícula') !!}
					{!! Form::text('student_enrollment', null, ['placeholder'=>'Matrícula do Aluno', 'data-mask' => '0000000000']) !!}
				</div>
				<div class="eight wide required field {{ $errors->has('equipment_code') ? 'error' : '' }}">
					{!! Form::label('equipment_code', 'Código') !!}
					{!! Form::text('equipment_code', null, ['placeholder'=>'Código do Equipamento']) !!}
				</div>
				<div class="four wide required field {{ $errors->has('deadline') ? 'error' : '' }}">
					{!! Form::label('deadline', 'Data Limite para Devolução') !!}
					<div class="ui calendar" id="deadlineCalendar">
						{!! Form::text('deadline', null, ['placeholder'=>'Data limite']) !!}
					</div>
				</div>
			</div>
			<div class="ui buttons fluid">
				<a class="ui button" href="/equipment">Cancelar</a>
				<div class="or" data-text="ou"></div>
				{!! Form::submit('Emprestar', ['class'=>'ui positive button']) !!}
			</div>
		{!! Form::close() !!}
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
		<table class="ui teal fixed celled table" id="studentsTable">
			<thead>
				<tr>
					<th class="center aligned two wide">Matrícula do Aluno</th>
					<th class="center aligned two wide">Código do Equipamento</th>
					<th class="center aligned two wide">Data do Empréstimo</th>
					<th class="center aligned two wide">Data Limite para Devolução</th>
					<th class="center aligned two wide">Data de Devolução</th>
					<th class="center aligned two wide">Estado</th>
					<th class="center aligned four wide">Opções</th>
				</tr>
			</thead>
			<tbody>
				@foreach($loans as $loan)
					<tr>
						<td class="center aligned">{{$loan->student->enrollment}}</td>
						<td class="center aligned">{{$loan->equipment->code}}</td>
						<td class="center aligned">{{$loan->loaned_on}}</td>
						<td class="center aligned">{{$loan->deadline}}</td>
						<td class="center aligned">{{$loan->returned_on}}</td>
						<td class="center aligned">{{$loan->status()}}</td>
						<td>
							<div class="ui buttons small fluid">
								<a class="ui animated fade button " tabindex="0" href="/students/{{$loan->id}}" @if($loop->first) data-content="Visualizar mais detalhes" data-position="left center" @endif>
									<div class="visible content">Ver</div>
									<div class="hidden content">
										<i class="icon search"></i>
									</div>
								</a>
								<a class="ui animated fade button primary" tabindex="0" href="/students/{{$loan->id}}/edit" @if($loop->first) data-content="Editar as informações do aluno" data-variation="wide" data-position="top center" @endif>
									<div class="visible content">Editar</div>
									<div class="hidden content">
										<i class="icon edit"></i>
									</div>
								</a>
								{!! Form::open(['method'=>'DELETE', 'action'=>['StudentsController@destroy', $loan->id], 'class'=>'ui form']) !!}
									{{csrf_field()}}
									<button class="ui animated fade button negative" tabindex="0" type="submit" @if($loop->first) data-content="Remover o aluno do sistema" data-position="bottom right" @endif>
										<div class="visible content">Deletar</div>
										<div class="hidden content">
											<i class="icon remove"></i>
										</div>
									</button>
								{!! Form::close() !!}
							</div>
						</td>
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

				$('table#studentsTable tbody').find('tr').each(function() {
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

		$('#deadlineCalendar').calendar({
			type: 'date',
			ampm: false,
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
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();
					return day + '/' + month + '/' + year;
				}
			}
		});
	</script>
@stop