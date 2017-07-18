@extends('layouts.app')

@section('content')
	<h1 class="ui center aligned icon header">
		<i class="student icon"></i>
		Alunos
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
	@if (count($students) == 0)
		<div class="ui icon warning message">
			<i class="huge comments outline icon"></i>
			<div class="content">
				<div class="header">
					Nenhum aluno encontrado
				</div>
			</div>
		</div>
	@else
		<table class="ui teal fixed celled table" id="studentsTable">
			<thead>
				<tr>
					<th class="center aligned two wide">Matrícula</th>
					<th class="center aligned two wide">CPF</th>
					<th class="center aligned two wide">Nome</th>
					<th class="center aligned two wide">Email</th>
					<th class="center aligned two wide">Curso</th>
					<th class="center aligned two wide">Telefone</th>
					<th class="center aligned four wide">Opções</th>
				</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
					<tr>
						<td class="center aligned">{{$student->enrollment}}</td>
						<td class="center aligned">{{$student->cpf}}</td>
						<td class="center aligned">{{$student->name}}</td>
						<td class="center aligned">{{$student->email}}</td>
						<td class="center aligned">{{$student->course}}</td>
						<td class="center aligned">{{$student->phone}}</td>
						<td>
							<div class="ui buttons small fluid">
								<a class="ui animated fade button " tabindex="0" href="/students/{{$student->id}}" @if($loop->first) data-content="Visualizar mais detalhes" data-position="left center" @endif>
									<div class="visible content">Ver</div>
									<div class="hidden content">
										<i class="icon search"></i>
									</div>
								</a>
								<a class="ui animated fade button primary" tabindex="0" href="/students/{{$student->id}}/edit" @if($loop->first) data-content="Editar as informações do aluno" data-variation="wide" data-position="top center" @endif>
									<div class="visible content">Editar</div>
									<div class="hidden content">
										<i class="icon edit"></i>
									</div>
								</a>
								{!! Form::open(['method'=>'DELETE', 'action'=>['StudentsController@destroy', $student->id], 'class'=>'ui form']) !!}
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
	</script>
@stop